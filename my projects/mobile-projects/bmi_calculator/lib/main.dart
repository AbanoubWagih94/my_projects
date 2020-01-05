import 'package:flutter/material.dart';

import './screens/input_page.dart';

const appId = 'ca-app-pub-1764230165689120~5482536019';

void main() => runApp(BmiCalculator());

class BmiCalculator extends StatefulWidget {
  @override
  State<StatefulWidget> createState() {
    return _BMICalculator();
  }
}

class _BMICalculator extends State<BmiCalculator> {

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      theme: ThemeData.dark().copyWith(
          primaryColor: Color(0XFF0A0E21),
          scaffoldBackgroundColor: Color(0XFF0A0E21)),
      home: InputPage(),
    );
  }
}
