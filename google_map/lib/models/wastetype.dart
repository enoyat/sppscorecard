// ignore_for_file: public_member_api_docs, sort_constructors_first
import 'dart:convert';

class WasteType {
  final int? id;
  final String name;
  final String details;

  WasteType({
    this.id,
    required this.name,
    required this.details,
  });

  Map<String, dynamic> toMap() {
    return <String, dynamic>{
      'id': id,
      'name': name,
      'details': details,
    };
  }

  factory WasteType.fromMap(Map<String, dynamic> map) {
    return WasteType(
      id: map['id'] != null ? map['id'] as int : null,
      name: map['name'] as String,
      details: map['details'] as String,
    );
  }

  String toJson() => json.encode(toMap());

  factory WasteType.fromJson(String source) =>
      WasteType.fromMap(json.decode(source) as Map<String, dynamic>);

  WasteType copyWith({
    int? id,
    String? name,
    String? details,
  }) {
    return WasteType(
      id: id ?? this.id,
      name: name ?? this.name,
      details: details ?? this.details,
    );
  }

  @override
  String toString() => 'WasteType(id: $id, name: $name, details: $details)';
}
