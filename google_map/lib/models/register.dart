import 'dart:convert';

// ignore_for_file: public_member_api_docs, sort_constructors_first
class RegisterModel {
  final int? id;
  final String name;
  final String email;
  final String gender;
  final String address;
  final double? latitude;
  final double? longitude;
  final String password;
  final String kdkab;
  final String kdkec;
  final String kdkel;
  final String? rt;
  final String? rw;
  final String? nohp;
  RegisterModel({
    this.id,
    required this.name,
    required this.email,
    required this.gender,
    required this.address,
    this.latitude,
    this.longitude,
    required this.password,
    required this.kdkab,
    required this.kdkec,
    required this.kdkel,
    this.rt,
    this.rw,
    this.nohp,
  });

  Map<String, dynamic> toMap() {
    return <String, dynamic>{
      'id': id,
      'name': name,
      'email': email,
      'gender': gender,
      'address': address,
      'latitude': latitude,
      'longitude': longitude,
      'password': password,
      'kdkab': kdkab,
      'kdkec': kdkec,
      'kdkel': kdkel,
      'rt': rt,
      'rw': rw,
      'nohp': nohp,
    };
  }

  factory RegisterModel.fromMap(Map<String, dynamic> map) {
    return RegisterModel(
      id: map['id'] != null ? map['id'] as int : null,
      name: map['name'] as String,
      email: map['email'] as String,
      gender: map['gender'] as String,
      address: map['address'] as String,
      latitude: map['latitude'] != null ? map['latitude'] as double : null,
      longitude: map['longitude'] != null ? map['longitude'] as double : null,
      password: map['password'] as String,
      kdkab: map['kdkab'] as String,
      kdkec: map['kdkec'] as String,
      kdkel: map['kdkel'] as String,
      rt: map['rt'] != null ? map['rt'] as String : null,
      rw: map['rw'] != null ? map['rw'] as String : null,
      nohp: map['nohp'] != null ? map['nohp'] as String : null,
    );
  }

  String toJson() => json.encode(toMap());

  factory RegisterModel.fromJson(String source) =>
      RegisterModel.fromMap(json.decode(source) as Map<String, dynamic>);

  RegisterModel copyWith({
    int? id,
    String? name,
    String? email,
    String? gender,
    String? address,
    double? latitude,
    double? longitude,
    String? password,
    String? kdkab,
    String? kdkec,
    String? kdkel,
    String? rt,
    String? rw,
    String? nohp,
  }) {
    return RegisterModel(
      id: id ?? this.id,
      name: name ?? this.name,
      email: email ?? this.email,
      gender: gender ?? this.gender,
      address: address ?? this.address,
      latitude: latitude ?? this.latitude,
      longitude: longitude ?? this.longitude,
      password: password ?? this.password,
      kdkab: kdkab ?? this.kdkab,
      kdkec: kdkec ?? this.kdkec,
      kdkel: kdkel ?? this.kdkel,
      rt: rt ?? this.rt,
      rw: rw ?? this.rw,
      nohp: nohp ?? this.nohp,
    );
  }

  @override
  String toString() {
    return 'RegisterModel(id: $id, name: $name, email: $email, gender: $gender, address: $address, latitude: $latitude, longitude: $longitude, password: $password, kdkab: $kdkab, kdkec: $kdkec, kdkel: $kdkel, rt: $rt, rw: $rw, nohp: $nohp)';
  }
}
