import 'package:flutter/material.dart';

import '../services/weather.dart';
import '../services/networking.dart';
import '../utilities/constants.dart';
import './city_screen.dart';

class LocationScreen extends StatefulWidget {
  var weatherData;
  LocationScreen(this.weatherData);
  @override
  State<StatefulWidget> createState() {
    return _LocationScreen();
  }
}

class _LocationScreen extends State<LocationScreen> {
  WeatherModel weatherModel = WeatherModel();
  int temperature;
  String weatherIcon;
  String weatherMsg;
  String cityName;
  @override
  void initState() {
    updateUI(widget.weatherData);
    super.initState();
  }

  void updateUI(var weatherData) {
    setState(() {
      if (weatherData == null) {
        temperature = 0;
        cityName = '';
        weatherIcon = 'Error';
        weatherMsg = 'Unable to get weather data';
        return;
      } else {
        double temp = weatherData['main']['temp'];
        temperature = temp.toInt();
        var condition = weatherData['weather'][0]['id'];
        cityName = weatherData['name'];
        weatherIcon = weatherModel.getWeatherIcon(condition);
        weatherMsg = weatherModel.getMessage(temperature);
      }
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
        body: Container(
      decoration: BoxDecoration(
        image: DecorationImage(
            image: AssetImage('images/location_background.jpg'),
            fit: BoxFit.cover,
            colorFilter: ColorFilter.mode(
                Colors.white.withOpacity(0.8), BlendMode.dstATop)),
      ),
      constraints: BoxConstraints.expand(),
      child: SafeArea(
        child: SingleChildScrollView(
            child: Column(
          mainAxisAlignment: MainAxisAlignment.spaceBetween,
          children: <Widget>[
            Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: <Widget>[
                FlatButton(
                  onPressed: () async {
                    var weatherData =
                        await NetworkHelper().getDataByCurrentLocation();
                    updateUI(weatherData);
                  },
                  child: Icon(
                    Icons.near_me,
                    color: Colors.white,
                    size: 50.0,
                  ),
                ),
                FlatButton(
                    onPressed: () {
                      Navigator.of(context)
                          .push(MaterialPageRoute(builder: (context) {
                        return CityScreen();
                      })).then((value) {
                        updateUI(value);
                      });
                    },
                    child: Icon(
                      Icons.location_city,
                      color: Colors.white,
                      size: 50.0,
                    )),
              ],
            ),
            Padding(
              padding: EdgeInsets.only(left: 15.0),
              child: Row(
                children: <Widget>[
                  Text(
                    '$temperature',
                    style: kTempTextStyle,
                  ),
                  Text(
                    '$weatherIcon',
                    style: kConditionTextStyle,
                  )
                ],
              ),
            ),
            Padding(
              padding: EdgeInsets.only(right: 15.0),
              child: Text(
                "$weatherMsg in $cityName!",
                textAlign: TextAlign.right,
                style: kMessageTextStyle,
              ),
            )
          ],
        )),
      ),
    ));
  }
}
