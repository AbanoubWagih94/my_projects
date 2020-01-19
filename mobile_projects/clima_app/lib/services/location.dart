import 'package:geolocator/geolocator.dart';

class Location {
  double lang;
  double lat;

  Future<void> getLocation() async {
    try {
      var postion = await Geolocator()
          .getCurrentPosition(desiredAccuracy: LocationAccuracy.low);
      this.lat = postion.latitude;
      this.lang = postion.longitude;
      print(lat);
    } catch (e) {
      print(e);
    }
  }
}
