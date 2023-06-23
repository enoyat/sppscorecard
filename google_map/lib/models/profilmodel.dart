import 'dart:convert';

// ignore_for_file: public_member_api_docs, sort_constructors_first
class Profil {
  final int id;
  final String gender;
  final String address;
  final String? birthday;
  final String name;
  final String email;
  final double? latitude;
  final double? longitude;
  final String? kdkab;
  final String? kdkec;
  final String? kdkel;
  final String? namakabupaten;
  final String? namakecamatan;
  final String? namakelurahan;
  Profil({
    required this.id,
    required this.gender,
    required this.address,
    this.birthday,
    required this.name,
    required this.email,
    this.latitude,
    this.longitude,
    this.kdkab,
    this.kdkec,
    this.kdkel,
    this.namakabupaten,
    this.namakecamatan,
    this.namakelurahan,
  });

  Map<String, dynamic> toMap() {
    return <String, dynamic>{
      'id': id,
      'gender': gender,
      'address': address,
      'birthday': birthday,
      'name': name,
      'email': email,
      'latitude': latitude,
      'longitude': longitude,
      'kdkab': kdkab,
      'kdkec': kdkec,
      'kdkel': kdkel,
      'namakabupaten': namakabupaten,
      'namakecamatan': namakecamatan,
      'namakelurahan': namakelurahan,
    };
  }

  factory Profil.fromMap(Map<String, dynamic> map) {
    return Profil(
      id: map['id'] as int,
      gender: map['gender'] as String,
      address: map['address'] as String,
      birthday: map['birthday'] != null ? map['birthday'] as String : null,
      name: map['name'] as String,
      email: map['email'] as String,
      latitude: map['latitude'] != null ? map['latitude'] as double : null,
      longitude: map['longitude'] != null ? map['longitude'] as double : null,
      kdkab: map['kdkab'] != null ? map['kdkab'] as String : null,
      kdkec: map['kdkec'] != null ? map['kdkec'] as String : null,
      kdkel: map['kdkel'] != null ? map['kdkel'] as String : null,
      namakabupaten:
          map['namakabupaten'] != null ? map['namakabupaten'] as String : null,
      namakecamatan:
          map['namakecamatan'] != null ? map['namakecamatan'] as String : null,
      namakelurahan:
          map['namakelurahan'] != null ? map['namakelurahan'] as String : null,
    );
  }

  String toJson() => json.encode(toMap());

  factory Profil.fromJson(String source) =>
      Profil.fromMap(json.decode(source) as Map<String, dynamic>);

  Profil copyWith({
    int? id,
    String? gender,
    String? address,
    String? birthday,
    String? name,
    String? email,
    double? latitude,
    double? longitude,
    String? kdkab,
    String? kdkec,
    String? kdkel,
    String? namakabupaten,
    String? namakecamatan,
    String? namakelurahan,
  }) {
    return Profil(
      id: id ?? this.id,
      gender: gender ?? this.gender,
      address: address ?? this.address,
      birthday: birthday ?? this.birthday,
      name: name ?? this.name,
      email: email ?? this.email,
      latitude: latitude ?? this.latitude,
      longitude: longitude ?? this.longitude,
      kdkab: kdkab ?? this.kdkab,
      kdkec: kdkec ?? this.kdkec,
      kdkel: kdkel ?? this.kdkel,
      namakabupaten: namakabupaten ?? this.namakabupaten,
      namakecamatan: namakecamatan ?? this.namakecamatan,
      namakelurahan: namakelurahan ?? this.namakelurahan,
    );
  }

  @override
  String toString() {
    return 'Profil(id: $id, gender: $gender, address: $address, birthday: $birthday, name: $name, email: $email, latitude: $latitude, longitude: $longitude, kdkab: $kdkab, kdkec: $kdkec, kdkel: $kdkel, namakabupaten: $namakabupaten, namakecamatan: $namakecamatan, namakelurahan: $namakelurahan)';
  }
}
