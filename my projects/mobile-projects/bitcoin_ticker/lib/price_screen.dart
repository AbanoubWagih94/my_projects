import 'dart:io';
import 'package:flutter/material.dart';
import 'package:flutter/cupertino.dart';

import './coin_data.dart';

class PriceScreen extends StatefulWidget {
  @override
  State<StatefulWidget> createState() {
    return _PriceScreen();
  }
}

class _PriceScreen extends State<PriceScreen> {
  String selectedItem = 'AUD';
  Map<String, dynamic> pricesList = {};
  List<double> prices = []; 
  bool isWaiting = false;

  @override
  void initState(){
    getData();
    super.initState();
  }
  DropdownButton<String> dropDownMenuForAndroid() {
    List<DropdownMenuItem<String>> dropDownList = [];

    for (String currency in currenciesList) {
      dropDownList.add(DropdownMenuItem<String>(
        child: Text(currency),
        value: currency,
      ));
    }

    return DropdownButton<String>(
      value: selectedItem,
      items: dropDownList,
      onChanged: (String value) {
        setState(() {
          selectedItem = value;
          getData();
        });
      },
    );
  }

  CupertinoPicker dropDownMenuForIOS() {
    List<Text> dropDownList = [];

    for (String currency in currenciesList) {
      dropDownList.add(Text(currency));
    }

    return CupertinoPicker(
      backgroundColor: Colors.lightBlue,
      itemExtent: 32,
      onSelectedItemChanged: (selectedIndex) {
        setState(() {
          selectedItem = currenciesList[selectedIndex];
          getData();
        });
      },
      children: dropDownList,
    );
  }

  void getData() async {
    isWaiting = true;
    try{ 
    pricesList = await CoinData().getCoinData(selectedItem);
    List<double> tempPrices = [];
    for(String crypto in cryptoList) {
      tempPrices.add(pricesList[crypto]);
    }
    setState(() {
     prices = tempPrices;
    });
    isWaiting = false;
    } catch (e) {
      print(e);
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Center(child: Text('🤑 Coin Ticker')),
      ),
      body: SafeArea(
        child: Container(
          child: Column(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            crossAxisAlignment: CrossAxisAlignment.stretch,
            children: <Widget>[
              Padding(
                  padding: EdgeInsets.all(15.0),
                  child: Column(
                    children: <Widget>[
                      Card(
                        margin: EdgeInsets.only(bottom: 15.0),
                        color: Colors.lightBlue,
                        child: Container(
                          padding: EdgeInsets.all(15.0),
                          alignment: Alignment.center,
                          child:
                              Text('1 ${cryptoList[0]} = ${ isWaiting == false ? prices[0]: '?'}  $selectedItem'),
                        ),
                      ),
                      Card(
                        margin: EdgeInsets.only(bottom: 15.0),
                        color: Colors.lightBlue,
                        child: Container(
                          padding: EdgeInsets.all(15.0),
                          alignment: Alignment.center,
                          child:
                              Text('1 ${cryptoList[1]} = ${ isWaiting == false ? prices[1]: '?'} $selectedItem'),
                        ),
                      ),
                      Card(
                        margin: EdgeInsets.only(bottom: 15.0),
                        color: Colors.lightBlue,
                        child: Container(
                          padding: EdgeInsets.all(15.0),
                          alignment: Alignment.center,
                          child:
                              Text('1 ${cryptoList[2]} = ${ isWaiting == false ? prices[2]: '?'} $selectedItem'),
                        ),
                      ),
                    ],
                  )),
              Container(
                  height: 150.0,
                  color: Colors.lightBlue,
                  alignment: Alignment.center,
                  child: Platform.isIOS
                      ? dropDownMenuForIOS()
                      : dropDownMenuForAndroid())
            ],
          ),
        ),
      ),
    );
  }
}
