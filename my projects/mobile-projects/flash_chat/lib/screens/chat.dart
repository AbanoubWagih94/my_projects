import 'package:flutter/material.dart';
import 'package:firebase_auth/firebase_auth.dart';
import 'package:cloud_firestore/cloud_firestore.dart';

import '../utilities/constans.dart';

class ChatScreen extends StatefulWidget {
  @override
  _ChatScreenState createState() => _ChatScreenState();
}

class _ChatScreenState extends State<ChatScreen> {
  final _auth = FirebaseAuth.instance;
  final _firestore = Firestore.instance;
  String message;
  FirebaseUser loggedUser;
  TextEditingController msgController = TextEditingController();

  void _getCurrentUser() async {
    try {
      final user = await _auth.currentUser();
      if (user != null) {
        loggedUser = user;
      }
    } catch (error) {
      print(error);
    }
  }

  @override
  void initState() {
    super.initState();

    _getCurrentUser();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        leading: null,
        title: Text('⚡️Chat'),
        centerTitle: true,
        backgroundColor: Colors.lightBlueAccent,
        actions: <Widget>[
          IconButton(
            icon: Icon(Icons.close),
            onPressed: () async {
              try {
                await _auth.signOut();
                Navigator.pop(context);
              } catch (error) {
                print(error);
              }
            },
          )
        ],
      ),
      body: SafeArea(
          child: Column(
        children: <Widget>[
          StreamBuilder<QuerySnapshot>(
            stream: _firestore.collection('messages').snapshots(),
            builder: (BuildContext context, snapshot) {
              if (!snapshot.hasData) {
                return CircularProgressIndicator(
                  backgroundColor: Colors.lightBlueAccent,
                );
              }
              return Expanded(
                child: ListView.builder(
                    reverse: true,
                    padding:
                        EdgeInsets.symmetric(horizontal: 10.0, vertical: 20.0),
                    itemCount: snapshot.data.documents.length,
                    itemBuilder: (BuildContext context, i) {
                      var message = snapshot.data.documents[i];
                      return MessageBubble(
                        isMe: loggedUser.email == message.data['sender'],
                        msg: message.data['message'],
                        sender: message.data['sender'],
                      );
                    }),
              );
            },
          ),
          Container(
            decoration: kMessageContainerDecoration,
            child: Row(
              children: <Widget>[
                Expanded(
                  child: TextField(
                    controller: msgController,
                    onChanged: (value) {
                      message = value;
                    },
                    decoration: kMessageTextFieldDecoration.copyWith(
                        hintText: 'Type your mesage here..',
                        hintStyle: TextStyle(color: Colors.black54)),
                    style: TextStyle(color: Colors.black),
                  ),
                ),
                FlatButton(
                  onPressed: () async {
                    try {
                      if (message.isNotEmpty) {
                        Map<String, dynamic> msg = {
                          'sender': loggedUser.email,
                          'message': message
                        };
                        msgController.clear();
                        await _firestore.collection('messages').add(msg);
                      }
                    } catch (error) {
                      print(error);
                    }
                  },
                  child: Text(
                    'Send',
                    style: kSendButtonTextStyle,
                  ),
                ),
              ],
            ),
          ),
        ],
      )),
    );
  }
}

class MessageBubble extends StatelessWidget {
  final String sender;
  final String msg;
  final bool isMe;

  MessageBubble({this.sender, this.msg, this.isMe});

  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: const EdgeInsets.all(10.0),
      child: Column(
        crossAxisAlignment:
            isMe ? CrossAxisAlignment.end : CrossAxisAlignment.start,
        children: <Widget>[
          Text(sender, style: TextStyle(color: Colors.black54, fontSize: 12.0)),
          Material(
            elevation: 5.0,
            color: isMe ? Colors.lightBlueAccent : Colors.white,
            borderRadius: isMe
                ? BorderRadius.only(
                    topLeft: Radius.circular(30.0),
                    bottomLeft: Radius.circular(30.0),
                    bottomRight: Radius.circular(30.0),
                  )
                : BorderRadius.only(
                    topLeft: Radius.circular(30.0),
                    topRight: Radius.circular(30.0),
                    bottomRight: Radius.circular(30.0),
                  ),
            child: Padding(
              padding: EdgeInsets.symmetric(vertical: 10.0, horizontal: 20.0),
              child: Text(msg,
                  style: TextStyle(
                      color: isMe ? Colors.white : Colors.black54, fontSize: 15)),
            ),
          )
        ],
      ),
    );
  }
}
