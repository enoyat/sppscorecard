import 'dart:convert';

// ignore_for_file: public_member_api_docs, sort_constructors_first
class DropZone {
  final int id;
  final String name;
  final double latitude;
  final double longitude;
  DropZone({
    required this.id,
    required this.name,
    required this.latitude,
    required this.longitude,
  });

  Map<String, dynamic> toMap() {
    return <String, dynamic>{
      'id': id,
      'name': name,
      'latitude': latitude,
      'longitude': longitude,
    };
  }

  factory DropZone.fromMap(Map<String, dynamic> map) {
    return DropZone(
      id: map['id'] as int,
      name: map['name'] as String,
      latitude: map['latitude'] as double,
      longitude: map['longitude'] as double,
    );
  }

  String toJson() => json.encode(toMap());

  factory DropZone.fromJson(String source) =>
      DropZone.fromMap(json.decode(source) as Map<String, dynamic>);

  DropZone copyWith({
    int? id,
    String? name,
    double? latitude,
    double? longitude,
  }) {
    return DropZone(
      id: id ?? this.id,
      name: name ?? this.name,
      latitude: latitude ?? this.latitude,
      longitude: longitude ?? this.longitude,
    );
  }

  @override
  String toString() {
    return 'DropZone(id: $id, name: $name, latitude: $latitude, longitude: $longitude)';
  }
}
