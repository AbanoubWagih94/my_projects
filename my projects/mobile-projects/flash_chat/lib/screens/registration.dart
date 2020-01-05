import 'package:flutter/material.dart';
import 'package:firebase_auth/firebase_auth.dart';

import '../components/rounded_button.dart';
import '../utilities/constans.dart';

class RegisterScreen extends StatefulWidget {
  @override
  _RegisterScreenState createState() => _RegisterScreenState();
}

class _RegisterScreenState extends State<RegisterScreen> {
  bool _isLoading = false;
  final _auth = FirebaseAuth.instance;
  Map<String, dynamic> _userData = {'email': null, 'password': null};

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Container(
          padding: EdgeInsets.symmetric(horizontal: 26.0),
          child: Column(
            mainAxisAlignment: MainAxisAlignment.center,
            children: <Widget>[
              Flexible(
                  child: Hero(
                tag: 'Logo',
                child: Container(
                  child: Image.asset('images/logo.png'),
                  height: 200.0,
                ),
              )),
              SizedBox(
                height: 48.0,
              ),
              TextField(
                  keyboardType: TextInputType.emailAddress,
                  onChanged: (value) {
                    _userData['email'] = value;
                  },
                  textAlign: TextAlign.center,
                  style: TextStyle(color: Colors.black54),
                  decoration: kTextFieldDecoration.copyWith(
                      hintText: ('Enter your email'))),
              SizedBox(
                height: 8.0,
              ),
              TextField(
                  obscureText: true,
                  onChanged: (value) {
                    _userData['password'] = value;
                  },
                  textAlign: TextAlign.center,
                  style: TextStyle(color: Colors.black54),
                  decoration: kTextFieldDecoration.copyWith(
                      hintText: ('Enter your password'))),
              SizedBox(
                height: 24.0,
              ),
              _isLoading
                  ? CircularProgressIndicator()
                  : RoundedButton(
                      color: Colors.lightBlueAccent,
                      title: 'Register',
                      onPressed: () async {
                        try {
                          setState(() {
                            _isLoading = true;
                          });
                          final newUser =
                              await _auth.createUserWithEmailAndPassword(
                                  email: _userData['email'],
                                  password: _userData['password']);
                          if (newUser != null) {
                            Navigator.pushReplacementNamed(
                                context, '/chat_screen');
                          }
                          setState(() {
                            _isLoading = false;
                          });
                        } catch (error) {
                          print(error);
                        }
                      }),
            ],
          )),
    );
  }
}
