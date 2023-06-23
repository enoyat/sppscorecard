import 'dart:async';
import 'dart:math';

import 'package:flutter/material.dart';
import 'package:geolocator/geolocator.dart';
import 'package:google_maps_flutter/google_maps_flutter.dart';

import '../shared/shared_bio.dart';

class MapPage extends StatefulWidget {
  const MapPage({super.key});

  @override
  State<MapPage> createState() => _MapPageState();
}

class _MapPageState extends State<MapPage> {
  void lokasi(double lat, double long) async {
    SharedBio.saveDouble('latitude', lat);
    SharedBio.saveDouble('longitude', long);
  }

  final Completer<GoogleMapController> _controller = Completer();
  String currentLocation = "Unknown";
  final String _title = "Lokasi";
  final String _address = "Alamat";
  final String _tempat = "Nama Tempat";

  Marker marker = const Marker(
    markerId: MarkerId('place_name'),
    position: LatLng(-7.816850304770861, 110.38049204957277),
    infoWindow: InfoWindow(
      title: 'title',
      snippet: 'address',
    ),
  );

  CameraPosition _mapInitialPosition = const CameraPosition(
    target: LatLng(-7.816850304770861, 110.38049204957277),
    zoom: 15.0,
  );
  double _latController = 0;
  double _longController = 0;

  void getLokasi() async {
    Position lokasi = await Geolocator.getCurrentPosition(
        desiredAccuracy: LocationAccuracy.high);
    setState(() {
      _latController = lokasi.latitude;
      _longController = lokasi.longitude;
      _mapInitialPosition = CameraPosition(
        target: LatLng(_latController, _longController),
        zoom: 15.0,
      );
      marker = Marker(
        markerId: MarkerId(_tempat),
        position: LatLng(_latController, _longController),
        infoWindow: InfoWindow(
          title: _title,
          snippet: _address,
        ),
      );
    });
  }

  double calculateDistance(lat1, lon1, lat2, lon2) {
    var p = 0.017453292519943295;
    var a = 0.5 -
        cos((lat2 - lat1) * p) / 2 +
        cos(lat1 * p) * cos(lat2 * p) * (1 - cos((lon2 - lon1) * p)) / 2;
    return 12742 * asin(sqrt(a));
  }

  void getLokasibaru() async {
    setState(() {
      _mapInitialPosition = CameraPosition(
        target: LatLng(_latController, _longController),
        zoom: 15.0,
      );
      marker = Marker(
        markerId: MarkerId(_tempat),
        position: LatLng(_latController, _longController),
        infoWindow: InfoWindow(
          title: _title,
          snippet: _address,
        ),
      );
    });
  }

  @override
  void initState() {
    super.initState();
    getLokasi();
  }

  @override
  Widget build(BuildContext context) {
    final size = MediaQuery.of(context).size;
    return Scaffold(
      appBar: AppBar(
        title: const Text('Lokasi Anda'),
      ),
      body: Stack(children: [
        Positioned(
          child: Container(
            height: size.height,
            width: size.width,
            color: const Color.fromARGB(255, 214, 223, 230),
            child: Column(children: [
              const SizedBox(height: 10),
              const Text(
                'Lokasi Anda:',
                style: TextStyle(
                  color: Color.fromARGB(255, 19, 6, 214),
                  fontSize: 12,
                ),
                textAlign: TextAlign.left,
              ),
              const SizedBox(height: 5),
              Text(
                'Latitude: $_latController \nLongitude: $_longController',
                style: const TextStyle(
                  color: Color.fromARGB(255, 8, 8, 8),
                  fontSize: 12,
                ),
                textAlign: TextAlign.left,
              ),
              const SizedBox(height: 5),
              const Text('Tap & tahan Area Map untuk memilih lokasi baru ',
                  style: TextStyle(
                    color: Color.fromARGB(255, 177, 7, 7),
                    fontSize: 12,
                  ),
                  textAlign: TextAlign.left),
              Row(
                mainAxisAlignment: MainAxisAlignment.center,
                children: [
                  ElevatedButton(
                    onPressed: () {
                      getLokasi();
                      _moveCamera();
                    },
                    child: const Text('Get Lokasi Anda'),
                  ),
                  const SizedBox(width: 10),
                  ElevatedButton(
                    onPressed: () {
                      lokasi(_latController, _longController);
                      Navigator.pop(context);
                    },
                    child: const Text('Pick Lokasi Anda'),
                  ),
                ],
              ),
            ]),
          ),
        ),
        Positioned(
          top: 130,
          left: 0,
          right: 0,
          child: Container(
            padding: const EdgeInsets.all(1),
            height: 800,
            child: GoogleMap(
              mapType: MapType.normal,
              initialCameraPosition: _mapInitialPosition,
              onMapCreated: (GoogleMapController controller) {
                _controller.complete(controller);
              },
              markers: {marker},
              onLongPress: (latLng) {
                setState(() {
                  _latController = latLng.latitude;
                  _longController = latLng.longitude;
                  getLokasibaru();
                  _moveCamera();
                });
              },
            ),
          ),
        ),
      ]),
    );
  }

  Future<void> _moveCamera() async {
    final GoogleMapController controller = await _controller.future;
    controller
        .animateCamera(CameraUpdate.newCameraPosition(_mapInitialPosition));
  }
}
