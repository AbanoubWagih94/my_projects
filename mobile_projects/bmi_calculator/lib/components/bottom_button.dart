import 'package:flutter/material.dart';

import 'constants.dart';

class BotttomButton extends StatelessWidget {
  final Function onTap;
  final String body;

  BotttomButton({@required this.onTap, @required this.body});

  @override
  Widget build(BuildContext context) {
    return GestureDetector(
        onTap: onTap,
        child: Container(
          height: kBottomContainerHeight,
          color: kBottomContainerColor,
          width: double.infinity,
          margin: EdgeInsets.only(top: 10.0),
          padding: EdgeInsets.only(bottom: 20.0),
          child: Center(child: Text(body, style: kLargeButtonText)),
        ));
  }
}
