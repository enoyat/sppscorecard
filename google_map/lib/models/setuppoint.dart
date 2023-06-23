import 'dart:convert';

// ignore_for_file: public_member_api_docs, sort_constructors_first
class SetupPoint {
  final int id;
  final int pointcurrency;
  final int pointperkilogram;
  final int pointperkilometer;
  SetupPoint({
    required this.id,
    required this.pointcurrency,
    required this.pointperkilogram,
    required this.pointperkilometer,
  });

  Map<String, dynamic> toMap() {
    return <String, dynamic>{
      'id': id,
      'pointcurrency': pointcurrency,
      'pointperkilogram': pointperkilogram,
      'pointperkilometer': pointperkilometer,
    };
  }

  factory SetupPoint.fromMap(Map<String, dynamic> map) {
    return SetupPoint(
      id: map['id'] as int,
      pointcurrency: map['pointcurrency'] as int,
      pointperkilogram: map['pointperkilogram'] as int,
      pointperkilometer: map['pointperkilometer'] as int,
    );
  }

  String toJson() => json.encode(toMap());

  factory SetupPoint.fromJson(String source) =>
      SetupPoint.fromMap(json.decode(source) as Map<String, dynamic>);

  SetupPoint copyWith({
    int? id,
    int? pointcurrency,
    int? pointperkilogram,
    int? pointperkilometer,
  }) {
    return SetupPoint(
      id: id ?? this.id,
      pointcurrency: pointcurrency ?? this.pointcurrency,
      pointperkilogram: pointperkilogram ?? this.pointperkilogram,
      pointperkilometer: pointperkilometer ?? this.pointperkilometer,
    );
  }

  @override
  String toString() {
    return 'SetupPoint(id: $id, pointcurrency: $pointcurrency, pointperkilogram: $pointperkilogram, pointperkilometer: $pointperkilometer)';
  }
}
