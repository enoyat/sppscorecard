// ignore_for_file: public_member_api_docs, sort_constructors_first
import 'dart:convert';

class AddsModel {
  final int? id;
  final String title;
  final String subtitle;
  final String image;
  final String status;
  final String datestart;
  final String dateend;
  AddsModel({
    this.id,
    required this.title,
    required this.subtitle,
    required this.image,
    required this.status,
    required this.datestart,
    required this.dateend,
  });

  Map<String, dynamic> toMap() {
    return <String, dynamic>{
      'id': id,
      'title': title,
      'subtitle': subtitle,
      'image': image,
      'status': status,
      'datestart': datestart,
      'dateend': dateend,
    };
  }

  factory AddsModel.fromMap(Map<String, dynamic> map) {
    return AddsModel(
      id: map['id'] != null ? map['id'] as int : null,
      title: map['title'] as String,
      subtitle: map['subtitle'] as String,
      image: map['image'] as String,
      status: map['status'] as String,
      datestart: map['datestart'] as String,
      dateend: map['dateend'] as String,
    );
  }

  String toJson() => json.encode(toMap());

  factory AddsModel.fromJson(String source) =>
      AddsModel.fromMap(json.decode(source) as Map<String, dynamic>);

  AddsModel copyWith({
    int? id,
    String? title,
    String? subtitle,
    String? image,
    String? status,
    String? datestart,
    String? dateend,
  }) {
    return AddsModel(
      id: id ?? this.id,
      title: title ?? this.title,
      subtitle: subtitle ?? this.subtitle,
      image: image ?? this.image,
      status: status ?? this.status,
      datestart: datestart ?? this.datestart,
      dateend: dateend ?? this.dateend,
    );
  }

  @override
  String toString() {
    return 'AddsModel(id: $id, title: $title, subtitle: $subtitle, image: $image, status: $status, datestart: $datestart, dateend: $dateend)';
  }
}
