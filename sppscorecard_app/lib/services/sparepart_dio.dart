import 'dart:convert';

import 'package:dio/dio.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:sppscorecard_app/models/sparepart.dart';

class SparepartDio {
  late Dio dio;
  String? baseUrl = "";

  Future<String> setter() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    return baseUrl = prefs.getString('urlapi')!;
  }

  SparepartDio() {
    dio = Dio();
  }

  Future<List<Sparepart>> listoftsparepart(String idsitename) async {
    try {
      baseUrl = await setter();
      final result = await dio.get('$baseUrl/listofsparepart/$idsitename');
      return (result.data as List)
          .map((e) => Sparepart.fromMap(e as Map<String, dynamic>))
          .toList();
    } catch (e) {
      throw Exception("Exception occured: $e");
    }
  }

  Future<List<Sparepart>> searchsparepart(String partname) async {
    try {
      baseUrl = await setter();
      final result = await dio.get('$baseUrl/searchsparepart/$partname');
      return (result.data as List)
          .map((e) => Sparepart.fromMap(e as Map<String, dynamic>))
          .toList();
    } catch (e) {
      throw Exception("Exception occured: $e");
    }
  }

  Future postdata(Map<String, dynamic> itemdetail) async {
    try {
      baseUrl = await setter();
      final dataku = json.encode(itemdetail);
      final result = await dio.post('$baseUrl/sparepart/store', data: dataku);
      return result.data;
    } catch (e) {
      throw Exception("Exception occured: $e");
    }
  }
}
