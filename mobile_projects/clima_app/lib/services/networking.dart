import 'dart:convert';

import 'package:http/http.dart' as http;
import './location.dart';

const String url = 'https://api.openweathermap.org/data/2.5/weather?';
const String api = 'c0c3c10ec4e8fc2c652ec4d2f962c11d';

class NetworkHelper {
  Future<dynamic> getDataByCurrentLocation() async {
    Location location = Location();
    await location.getLocation();
    http.Response response = await http.get(
        '${url}appid=${api}&lat=${location.lat}&lon=${location.lang}&units=metric');

    if (response.statusCode == 200) {
      var data = jsonDecode(response.body);
      return data;
    } else {
      return 'error';
    }
  }

  Future<dynamic> getDataByCityName(String cityName) async {
    http.Response response =
        await http.get('${url}appid=${api}&q=${cityName}&units=metric');
    if (response.statusCode == 200) {
      var data = jsonDecode(response.body);
      return data;
    } else {
      return null;
    }
  }
}
