import 'package:flutter/material.dart';

import '../components/reusable_card.dart';
import '../components/constants.dart';
import '../components/bottom_button.dart';

class ResultsPage extends StatelessWidget {
  final String bmi;
  final String result;
  final String interpretation;

  ResultsPage(
      {@required this.bmi,
      @required this.interpretation,
      @required this.result});
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Center(child: Text('BMI CALCULATOR')),
      ),
      body: Column(
        mainAxisAlignment: MainAxisAlignment.spaceEvenly,
        crossAxisAlignment: CrossAxisAlignment.stretch,
        children: <Widget>[
          Expanded(
            child: Container(
              padding: EdgeInsets.all(15.0),
              alignment: Alignment.bottomLeft,
              child: Text('Your Result', style: kTitleText),
            ),
          ),
          Expanded(
            flex: 5,
            child: ReusableCard(
              activeColor: kActiveColor,
              cardChild: Column(
                mainAxisAlignment: MainAxisAlignment.spaceEvenly,
                crossAxisAlignment: CrossAxisAlignment.center,
                children: <Widget>[
                  Text(result.toUpperCase(), style: kResultText),
                  Text(bmi, style: kBMIText),
                  SizedBox(
                    height: 20.0,
                  ),
                  Text(
                    'Normal BMI Range:',
                    style: TextStyle(color: Color(0xFF8D8E98), fontSize: 20.0),
                  ),
                  Text(
                    '18.5 - 25 kg/m2',
                    style: TextStyle(fontSize: 20.0),
                  ),
                  SizedBox(
                    height: 20.0,
                  ),
                  Text(
                    interpretation,
                    style: kBodyText,
                    textAlign: TextAlign.center,
                  )
                ],
              ),
            ),
          ),
          SizedBox(
            height: 10.0,
          ),
          BotttomButton(
            onTap: () {
              Navigator.pop(context);
            },
            body: "RE-CALCULATE",
          )
        ],
      ),
    );
  }
}
