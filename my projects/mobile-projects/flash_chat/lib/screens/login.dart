import 'package:flutter/material.dart';
import 'package:firebase_auth/firebase_auth.dart';

import '../components/rounded_button.dart';
import '../utilities/constans.dart';

class LoginScreen extends StatefulWidget {
  @override
  _LoginScreenState createState() => _LoginScreenState();
}

class _LoginScreenState extends State<LoginScreen> {
  bool _isLoading = false;
  final Map<String, dynamic> _userDara = {'email': null, 'password': null};
  final _auth = FirebaseAuth.instance;

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
                    _userDara['email'] = value;
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
                    _userDara['password'] = value;
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
                      title: 'Log In',
                      onPressed: () async {
                        try {
                          setState(() {
                            _isLoading = true;
                          });
                          final user = await _auth.signInWithEmailAndPassword(
                              email: _userDara['email'],
                              password: _userDara['password']);
                          if (user != null) {
                            Navigator.pushReplacementNamed(
                                context, '/chat_screen');
                          }
                          setState(() {
                            _isLoading = false;
                          });
                        } catch (error) {
                          print(error);
                        }
                      },
                    )
            ],
          )),
    );
  }
}
