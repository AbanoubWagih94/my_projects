import 'package:flutter/material.dart';
import 'package:flutter_spinkit/flutter_spinkit.dart';

import '../services/networking.dart';
import './location_screen.dart';

class LoadingScreen extends StatefulWidget {
  @override 
  State<StatefulWidget> createState(){
    return _LoadingScreen();
  }
}

class _LoadingScreen extends State<LoadingScreen>{
  NetworkHelper network = NetworkHelper();
  @override
  void initState() {
    getLocationData();
    super.initState();
  }

  void getLocationData() async{
    var data = await network.getDataByCurrentLocation();
    Navigator.of(context).push(MaterialPageRoute(builder: (context){
      return LocationScreen(data);
    }));
  }
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Center(
        child: SpinKitDoubleBounce(
          color: Colors.white,
          size: 100.0,
        )
      ),
    );
  }
}