import 'package:flutter/material.dart';

import '../utilities/constants.dart';
import '../services/networking.dart';
class CityScreen extends StatefulWidget {
  @override
  State<StatefulWidget> createState() {
    return _CityScreen();
  }
}

class _CityScreen extends State<CityScreen> {
  String city = '';
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Container(
        decoration: BoxDecoration(
            image: DecorationImage(
          image: AssetImage('images/city_background.jpg'),
          fit: BoxFit.cover,
        )),
        constraints: BoxConstraints.expand(),
        child: SafeArea(
            child: Column(
          children: <Widget>[
            Align(
              alignment: Alignment.topLeft,
              child: FlatButton(
                onPressed: () {
                  Navigator.of(context).pop();
                },
                child:
                    Icon(Icons.arrow_back_ios, size: 50.0, color: Colors.white),
              ),
            ),
            Container(
              padding: EdgeInsets.all(20.0),
              child: TextField(
                style: TextStyle(color: Colors.black),
                decoration: kTextFieldInputDecoration,
                onChanged: (String value) {
                  city = value;
                },
              ),
            ),
            FlatButton(
              onPressed: () async{
                var weatherData =
                        await NetworkHelper().getDataByCityName(city);
                  Navigator.of(context).pop(weatherData);      
              },
              child: Text(
                'Get Weather',
                style: kButtonTextStyle,
              ),
            )
          ],
        )),
      ),
    );
  }
}
