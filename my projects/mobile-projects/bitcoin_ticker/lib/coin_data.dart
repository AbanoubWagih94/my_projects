import 'dart:convert';
import 'package:http/http.dart' as http;

const List<String> currenciesList = [
  'AUD',
  'BRL',
  'CAD',
  'CNY',
  'EUR',
  'GBP',
  'HKD',
  'IDR',
  'ILS',
  'INR',
  'JPY',
  'MXN',
  'NOK',
  'NZD',
  'PLN',
  'RON',
  'RUB',
  'SEK',
  'SGD',
  'USD',
  'ZAR'
];

const List<String> cryptoList = ['BTC', 'ETH', 'LTC'];
const String bitcoinUrl =
    'https://apiv2.bitcoinaverage.com/indices/global/ticker/';

class CoinData {
  Future<Map<String, dynamic>> getCoinData(String selectedCurrency) async {
    Map<String, dynamic> cryptoPrices = {};

    for (String crypto in cryptoList) {
      http.Response response =
          await http.get('$bitcoinUrl$crypto$selectedCurrency');
      if (response.statusCode == 200) {
        Map<String, dynamic> cryptoData = json.decode(response.body);
        cryptoPrices[crypto] = cryptoData['last'];
      } else {
        print(response.statusCode);
        throw 'Problem with the get request';
      }
    }

    return cryptoPrices;
  }
}
