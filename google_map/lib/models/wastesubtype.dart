// ignore_for_file: public_member_api_docs, sort_constructors_first
import 'dart:convert';

class WasteSubType {
  final int? id;
  final String name;
  final String details;
  final int? type;

  WasteSubType({
    this.id,
    required this.name,
    required this.details,
    this.type,
  });

  Map<String, dynamic> toMap() {
    return <String, dynamic>{
      'id': id,
      'name': name,
      'details': details,
      'type': type,
    };
  }

  factory WasteSubType.fromMap(Map<String, dynamic> map) {
    return WasteSubType(
      id: map['id'] != null ? map['id'] as int : null,
      name: map['name'] as String,
      details: map['details'] as String,
      type: map['type'] != null ? map['type'] as int : null,
    );
  }

  String toJson() => json.encode(toMap());

  factory WasteSubType.fromJson(String source) =>
      WasteSubType.fromMap(json.decode(source) as Map<String, dynamic>);

  @override
  String toString() {
    return 'WasteSubType(id: $id, name: $name, details: $details, type: $type)';
  }

  WasteSubType copyWith({
    int? id,
    String? name,
    String? details,
    int? type,
  }) {
    return WasteSubType(
      id: id ?? this.id,
      name: name ?? this.name,
      details: details ?? this.details,
      type: type ?? this.type,
    );
  }
}
