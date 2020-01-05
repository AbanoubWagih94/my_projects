import 'package:flutter/material.dart';

import 'story_brain.dart';

StoryBrain storyBrain = StoryBrain();
void main() => runApp(Destini());

class Destini extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      theme: ThemeData(brightness: Brightness.dark),
      home: DestiniPage(),
    );
  }
}

class DestiniPage extends StatefulWidget {
  @override
  State<StatefulWidget> createState() {
    return _DestiniPage();
  }
}

class _DestiniPage extends State<DestiniPage> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Container(
          decoration: BoxDecoration(
            image: DecorationImage(
                image: AssetImage('images/background.png'), fit: BoxFit.cover),
          ),
          padding: EdgeInsets.symmetric(vertical: 50.0, horizontal: 15.0),
          constraints: BoxConstraints.expand(),
          child: SafeArea(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.stretch,
              children: <Widget>[
                Expanded(
                  flex: 12,
                  child: Center(
                      child: Text(
                    storyBrain.getStoryTitle(),
                    style: TextStyle(
                      fontSize: 25.0,
                    ),
                  )),
                ),
                Expanded(
                  flex: 2,
                  child: FlatButton(
                    child: Text(
                      storyBrain.getChoiceOne(),
                      style: TextStyle(
                        fontSize: 20.0,
                      ),
                    ),
                    color: Colors.red,
                    onPressed: () {
                      setState(() {
                        storyBrain.nextStory(1);
                      });
                    },
                  ),
                ),
                SizedBox(
                  height: 20.0,
                ),
                storyBrain.showOneButton() == true
                    ? Expanded(
                        flex: 2,
                        child: FlatButton(
                          child: Text(
                            storyBrain.getChoiceTwo(),
                            style: TextStyle(
                              fontSize: 20.0,
                            ),
                          ),
                          color: Colors.blue,
                          onPressed: () {
                            setState(() {
                              storyBrain.nextStory(2);
                            });
                          },
                        ),
                      )
                    : Container()
              ],
            ),
          )),
    );
  }
}
