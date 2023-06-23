import 'package:dio/dio.dart';
import 'package:google_map/models/deposit.dart';
import 'package:google_map/models/dropzone.dart';
import 'package:google_map/models/setuppoint.dart';
import 'package:google_map/models/useraccount.dart';

import '../models/profilmodel.dart';
import '../models/wilayah_model.dart';

class NetworkManager {
  late Dio dio;
  final String baseUrl = "http://192.168.100.104:8000/api";
  NetworkManager() {
    dio = Dio();
  }

  Future login(String email, String password) async {
    try {
      final result = await dio.post(
        '$baseUrl/login',
        data: {
          "email": email,
          "password": password,
        },
      );
      return result.data;
    } catch (e) {
      throw Exception("Exception occured: $e");
    }
  }

  Future<List<DropZone>> getdropzone() async {
    try {
      final result = await dio.get('$baseUrl/dropzone');
      return (result.data as List)
          .map((e) => DropZone.fromMap(e as Map<String, dynamic>))
          .toList();
    } catch (e) {
      throw Exception("Exception occured: $e");
    }
  }

  Future<List<Deposit>> getdeposit(int id) async {
    try {
      final result = await dio.get('$baseUrl/depositcustomer?id=$id');
      return (result.data as List)
          .map((e) => Deposit.fromMap(e as Map<String, dynamic>))
          .toList();
    } catch (e) {
      throw Exception("Exception occured: $e");
    }
  }

  Future<List<SetupPoint>> getsetup() async {
    try {
      final result = await dio.get('$baseUrl/getsetup');
      return (result.data as List)
          .map((e) => SetupPoint.fromMap(e as Map<String, dynamic>))
          .toList();
    } catch (e) {
      throw Exception("Exception occured: $e");
    }
  }

  Future<List<UserAccount>> getaccount(int id) async {
    try {
      final result = await dio.get('$baseUrl/getaccount?id=$id');
      return (result.data as List)
          .map((e) => UserAccount.fromMap(e as Map<String, dynamic>))
          .toList();
    } catch (e) {
      throw Exception("Exception occured: $e");
    }
  }

  Future<List<Profil>> getprofil(int id) async {
    try {
      final result = await dio.get('$baseUrl/customer/getprofil?id=$id');
      return (result.data as List)
          .map((e) => Profil.fromMap(e as Map<String, dynamic>))
          .toList();
    } catch (e) {
      throw Exception("Exception occured: $e");
    }
  }

  Future<List<UserAccount>> getaccountworker(int id) async {
    try {
      final result = await dio.get('$baseUrl/worker/getaccount?id=$id');
      return (result.data as List)
          .map((e) => UserAccount.fromMap(e as Map<String, dynamic>))
          .toList();
    } catch (e) {
      throw Exception("Exception occured: $e");
    }
  }

  Future<List<Wilayah>> getpropinsi(String id) async {
    try {
      final result = await dio.get('$baseUrl/wilayah/getpropinsi?id=$id');
      return (result.data as List)
          .map((e) => Wilayah.fromMap(e as Map<String, dynamic>))
          .toList();
    } catch (e) {
      throw Exception("Exception occured: $e");
    }
  }

  Future<List<Wilayah>> getkabupaten(String id) async {
    try {
      final result = await dio.get('$baseUrl/wilayah/getkabupaten/$id');
      return (result.data as List)
          .map((e) => Wilayah.fromMap(e as Map<String, dynamic>))
          .toList();
    } catch (e) {
      throw Exception("Exception occured: $e");
    }
  }

  Future<List<Wilayah>> getkecamatan(String id) async {
    try {
      final result = await dio.get('$baseUrl/wilayah/getkecamatan/$id');
      return (result.data as List)
          .map((e) => Wilayah.fromMap(e as Map<String, dynamic>))
          .toList();
    } catch (e) {
      throw Exception("Exception occured: $e");
    }
  }

  Future<List<Wilayah>> getkelurahan(String id) async {
    try {
      final result = await dio.get('$baseUrl/wilayah/getkelurahan/$id');
      return (result.data as List)
          .map((e) => Wilayah.fromMap(e as Map<String, dynamic>))
          .toList();
    } catch (e) {
      throw Exception("Exception occured: $e");
    }
  }

  Future<UserAccount> updateCustomer(UserAccount item) async {
    final result = await dio.post(
      "$baseUrl/customer/update",
      data: item.toMap(),
    );
    return UserAccount.fromMap(result.data as Map<String, dynamic>);
  }
}
