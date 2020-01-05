import 'package:flutter/material.dart';

class ReusableCard extends StatelessWidget {
  final Color activeColor;
  final Widget cardChild;
  final Function onPress;

  ReusableCard({@required this.activeColor, this.cardChild, this.onPress});

  @override
  Widget build(BuildContext context) {
    return GestureDetector(
        onTap: onPress,
        child: Card(
          margin: EdgeInsets.all(15.0),
          color: activeColor,
          child: Container(
            child: cardChild,
          ),
        ));
  }
}
