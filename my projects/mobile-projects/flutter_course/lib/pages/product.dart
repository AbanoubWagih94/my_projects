import 'package:flutter/material.dart';
import '../ui_elements/title_default.dart';
import '../models/product.dart';
import 'package:map_view/map_view.dart';
import '../widgets/products/price_tag.dart';
import '../widgets/products/address_tag.dart';
import '../widgets/products/product_fab.dart';

class ProdcutPage extends StatelessWidget {
  final Product product;
  ProdcutPage(this.product);

  void _showMap() {
    final List<Marker> markers = <Marker>[
      Marker('position', 'position', product.location.latitude,
          product.location.longitude)
    ];
    final cameraPosition = CameraPosition(
        Location(product.location.latitude, product.location.longitude), 14.0);
    final mapView = MapView();
    mapView.show(
        MapOptions(
            initialCameraPosition: cameraPosition,
            mapViewType: MapViewType.normal,
            title: 'Product Location'),
        toolbarActions: [ToolbarAction('Close', 1)]);
    mapView.onToolbarAction.listen((int id) {
      if (id == 1) {
        mapView.dismiss();
      }
    });
    mapView.onMapReady.listen((_) {
      mapView.setMarkers(markers);
    });
  }

  Widget _buildTitlePriceRow() {
    return Container(
        padding: EdgeInsets.only(top: 10.0),
        child: Row(
          mainAxisAlignment: MainAxisAlignment.center,
          children: <Widget>[
            TitleDefault(product.title),
            SizedBox(width: 8.0),
            PriceTag(product.price.toString())
          ],
        ));
  }

  /* _showWarningDialog(BuildContext context) {
    showDialog(
        context: context,
        builder: (BuildContext context) {
          return AlertDialog(
            title: Text('Are you sure?'),
            content: Text('This action cannot be undone!'),
            actions: <Widget>[
              FlatButton(
                child: Text('DISCARD'),
                onPressed: () => Navigator.pop(context),
              ),
              FlatButton(
                  child: Text('CONTINUE'),
                  onPressed: () {
                    Navigator.pop(context);
                    Navigator.pop(context, true);
                  })
            ],
          );
        });
  } */

  @override
  Widget build(BuildContext context) {
    return WillPopScope(
        onWillPop: () {
          Navigator.pop(context, false);
          return Future.value(false);
        },
        child: Scaffold(
          //appBar: AppBar(
          //title: Text(product.title),
          //),
          body: CustomScrollView(
            slivers: <Widget>[
              SliverAppBar(
                expandedHeight: 256.0,
                pinned: true,
                flexibleSpace: FlexibleSpaceBar(
                  title: Text(product.title),
                  background: Hero(
                      tag: product.id,
                      child: FadeInImage(
                        image: AssetImage('assets/food.jpg'),
                        height: 300.0,
                        fit: BoxFit.cover,
                        placeholder: AssetImage('assets/food.jpg'),
                      )),
                ),
              ),
              SliverList(
                delegate: SliverChildListDelegate([
                  Container(
                    padding: EdgeInsets.all(10.0),
                    child: Text(product.title),
                  ),
                  _buildTitlePriceRow(),
                  GestureDetector(
                    child: AddressTag(product.location.address),
                    onTap: _showMap,
                  ),
                  Container(
                    padding: EdgeInsets.all(10.0),
                    child: Text(product.description),
                  ),
                ]),
              ),
            ],
          ),

          floatingActionButton: ProductFAB(product),
        ));
  }
}
