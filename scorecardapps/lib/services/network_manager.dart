import 'package:dio/dio.dart';

class NetworkManager {
  late Dio dio;
  //final String baseUrl = "https://satriapirantiperkasa.com/api";
  //final String baseUrl = "http://192.168.200.252:8000/api";
  NetworkManager() {
    dio = Dio();
  }

  Future login(String email, String password, String urlapi) async {
    try {
      final result = await dio.post(
        '$urlapi/login',
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
}
