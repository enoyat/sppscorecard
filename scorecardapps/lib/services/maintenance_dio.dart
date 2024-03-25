import 'dart:io';

import 'package:dio/dio.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:scorecardapps/models/trouble.dart';

import '../models/dokumenmaintenance.dart';
import '../models/unit.dart';

class MaintenanceDio {
  late SharedPreferences prefs;
  //String baseUrl = "https://danone.satriapirantiperkasa.com/api";
  String? baseUrl = "";

  Future<String> setter() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    return baseUrl = prefs.getString('urlapi')!;
  }

  late Dio dio;
  MaintenanceDio() {
    dio = Dio();
  }
  Future<List<Unit>> listofunit(String idsitename) async {
    try {
      baseUrl = await setter();
      final result = await dio.get('$baseUrl/listofunit/$idsitename');

      return (result.data as List)
          .map((e) => Unit.fromMap(e as Map<String, dynamic>))
          .toList();
    } catch (e) {
      throw Exception("Exception occured: $e");
    }
  }

  Future<List<Unit>> getunit(String kdunit) async {
    try {
      baseUrl = await setter();
      final result = await dio.get('$baseUrl/getunit/$kdunit');

      return (result.data as List)
          .map((e) => Unit.fromMap(e as Map<String, dynamic>))
          .toList();
    } catch (e) {
      throw Exception("Exception occured: $e");
    }
  }

  Future<List<Trouble>> listoftrouble(int idsitename) async {
    try {
      baseUrl = await setter();
      final result = await dio.get('$baseUrl/listoftrouble/$idsitename');
      return (result.data as List)
          .map((e) => Trouble.fromMap(e as Map<String, dynamic>))
          .toList();
    } catch (e) {
      throw Exception("Exception occured: $e");
    }
  }

  Future<List<Trouble>> gettrouble(int id) async {
    try {
      baseUrl = await setter();
      final result = await dio.get('$baseUrl/gettrouble/$id');
      return (result.data as List)
          .map((e) => Trouble.fromMap(e as Map<String, dynamic>))
          .toList();
    } catch (e) {
      throw Exception("Exception occured: $e");
    }
  }

  Future postData(Map<String, dynamic> item) async {
    try {
      baseUrl = await setter();
      final result = await dio.post("$baseUrl/maintenance/store", data: item);
      return result.data;
    } catch (e) {
      throw Exception(e);
    }
  }

  Future uploadfoto(File file, int idaction, String keterangan) async {
    baseUrl = await setter();
    String fileName = file.path.split('/').last;
    String namafile = "";
    FormData formData = FormData.fromMap({
      "image": await MultipartFile.fromFile(
        file.path,
        filename: fileName,
      ),
      "idaction": idaction,
      "keterangan": keterangan,
      "transaksi": "maintenance"
    });
    try {
      await dio
          .post(
            "$baseUrl/apimedia",
            data: formData,
          )
          .then((value) => namafile = value.data);

      return namafile;
    } catch (e) {
      throw Exception(e);
    }
  }

  Future<List<Dokumenmaintenance>> listdokumen(int idaction) async {
    try {
      baseUrl = await setter();
      final result =
          await dio.get('$baseUrl/maintenance/listdokumen/$idaction');
      return (result.data as List)
          .map((e) => Dokumenmaintenance.fromMap(e as Map<String, dynamic>))
          .toList();
    } catch (e) {
      throw Exception("Exception occured: $e");
    }
  }
}
