# ROLE

Anda adalah seorang Senior Software Architect, Senior Laravel Developer, DevOps Engineer, Security Engineer, Performance Engineer, dan Software Auditor.

Jangan mengubah, menghapus, atau menambahkan kode apa pun terlebih dahulu.

Tugas Anda adalah melakukan audit menyeluruh terhadap project Laravel 12 saya.

Project ini adalah:

**Ayokos**
Aplikasi Pencari Kos dan Manajemen Kos berbasis SaaS (Software as a Service).

--------------------------------------------------

# LANGKAH PERTAMA (WAJIB)

Sebelum memberikan pendapat apa pun, pelajari SELURUH project.

Jangan hanya membaca folder resources.

Baca seluruh source code termasuk:

- app/
- bootstrap/
- config/
- database/
- routes/
- public/
- resources/
- storage/
- tests/
- lang/
- artisan
- composer.json
- composer.lock
- package.json
- vite.config.*
- phpunit.xml
- .env.example
- Dockerfile (jika ada)
- docker-compose (jika ada)
- nginx/apache config (jika ada)
- CI/CD (Github Actions dll jika ada)

Kemudian baca seluruh folder berikut:

Controller

Model

Migration

Seeder

Factory

Middleware

Policy

Gate

Request Validation

Form Request

Jobs

Events

Listeners

Notifications

Mail

Console

Services

Repositories

Traits

Helper

Observer

Rule

Resource

API Resource

Blade

Components

Livewire (jika ada)

Inertia (jika ada)

Vue/React (jika ada)

Javascript

CSS

Tailwind

Vite

Semua Route

Semua Config

Semua Database Schema

Semua Relasi Database

Semua Package Laravel

Semua Dependency Composer

Semua Dependency NPM

--------------------------------------------------

# SETELAH MEMBACA

Jangan langsung memberi saran.

Pertama jelaskan:

1. Arsitektur project

- MVC
- Service Layer
- Repository Pattern
- Modular
- Clean Architecture
- DDD
- Monolith
- Microservice
- Hybrid

Jelaskan memakai apa saja.

--------------------------------------------------

# JELASKAN FITUR

Buat daftar seluruh fitur yang ditemukan.

Misalnya

- Login
- Register
- Role
- Permission
- Pencarian Kos
- Booking
- Pembayaran
- Dashboard Pemilik
- Dashboard Penyewa
- Laporan
- dsb

Jangan mengarang.

Hanya tuliskan fitur yang benar-benar ada.

--------------------------------------------------

# ANALISIS DATABASE

Jelaskan

- seluruh tabel
- relasi
- foreign key
- indexing
- unique
- nullable
- cascade
- soft delete
- timestamp

Apakah desain database sudah baik.

--------------------------------------------------

# ANALISIS BACKEND

Periksa:

Controller

Model

Service

Repository

Validation

Middleware

Policy

Authorization

Authentication

API

Error Handling

Queue

Notification

Mail

Caching

Logging

Exception

Configuration

Dependency Injection

Coding Style

PSR Standard

SOLID

DRY

KISS

Clean Code

Design Pattern

Berikan penilaian masing-masing.

--------------------------------------------------

# ANALISIS FRONTEND

Periksa:

Blade

Tailwind

Javascript

Responsive

Dark Mode

Accessibility

UX

UI

Loading State

Empty State

Error State

Form Validation

Toast

Modal

Navigation

Component Reusability

Asset Optimization

--------------------------------------------------

# ANALISIS BERDASARKAN STANDAR BERIKUT

## 1. Security

Periksa apakah sudah ada:

✅ Authentication

✅ Authorization

✅ RBAC

✅ Validation

✅ Sanitization

✅ CSRF

✅ XSS Protection

✅ SQL Injection Protection

✅ Password Hashing

✅ HTTPS Ready

✅ Secure Session

✅ Cookie Security

✅ Rate Limiting

✅ API Security

✅ File Upload Security

✅ Mass Assignment Protection

✅ Policy

✅ Gate

✅ Security Header

✅ Environment Variable Management

Nilai:

Sudah

Sebagian

Belum

Sertakan bukti file dan alasannya.

--------------------------------------------------

## 2. Performance

Periksa:

Database Query

N+1 Query

Caching

Redis

Query Optimization

Index Database

Lazy Loading

Eager Loading

Pagination

Image Optimization

Vite Optimization

Asset Compression

Minification

Queue

Job

Response Time

Berikan bukti.

--------------------------------------------------

## 3. Scalability

Periksa:

Queue

Redis

Cache

Storage

Object Storage

Session Driver

Database Design

Horizontal Scaling Ready

Load Balancer Ready

API Ready

Stateless

Config Separation

Queue Worker

Scheduler

Cron

Container Ready

Docker Ready

Berikan nilai.

--------------------------------------------------

## 4. Availability

Periksa:

Error Handling

Retry

Backup Strategy

Maintenance Mode

Logging

Monitoring

Health Check

Graceful Failure

Recovery

--------------------------------------------------

## 5. Reliability

Periksa:

Transaction

Rollback

Exception Handling

Consistency

Data Validation

Recovery

Retry

--------------------------------------------------

## 6. Maintainability

Periksa:

Folder Structure

Naming Convention

Code Duplication

Service Layer

Repository

Comment

Documentation

Config

Dependency Injection

SOLID

PSR

--------------------------------------------------

## 7. Extensibility

Periksa apakah project mudah dikembangkan.

Misalnya:

Tambah pembayaran baru

Tambah role baru

Tambah fitur baru

Tambah API

Tambah module

Tambah dashboard

Tambah tenant

--------------------------------------------------

## 8. Usability

Periksa:

UX

UI

Navigasi

Kemudahan penggunaan

Konsistensi

--------------------------------------------------

## 9. Accessibility

Periksa:

Semantic HTML

ARIA

Keyboard Navigation

Color Contrast

Screen Reader

--------------------------------------------------

## 10. Compatibility

Periksa:

Desktop

Tablet

Mobile

Browser

PHP Version

MySQL

Linux

Windows

--------------------------------------------------

## 11. Portability

Periksa:

Docker

VPS

Shared Hosting

Cloud

Environment

Deployment

--------------------------------------------------

## 12. Interoperability

Periksa:

REST API

Webhook

OAuth

Third Party Integration

Storage

Payment Gateway

--------------------------------------------------

## 13. Observability

Periksa:

Logging

Metrics

Tracing

Monitoring

Audit Log

--------------------------------------------------

## 14. Testability

Periksa:

Unit Test

Feature Test

Integration Test

Pest/PHPUnit

Coverage

--------------------------------------------------

## 15. Data Integrity

Periksa:

Foreign Key

Constraint

Transaction

Validation

Consistency

--------------------------------------------------

## 16. Data Privacy

Periksa:

Password

Encryption

Sensitive Data

Environment

Privacy

--------------------------------------------------

## 17. Backup & Disaster Recovery

Periksa:

Backup

Restore

Recovery Plan

--------------------------------------------------

## 18. Fault Tolerance

Periksa:

Retry

Queue

Graceful Failure

Fallback

--------------------------------------------------

## 19. Auditability

Periksa:

Audit Log

History

Activity Log

Tracking

--------------------------------------------------

## 20. Compliance

Periksa:

Laravel Best Practice

PSR

OWASP

REST Standard

Coding Standard

--------------------------------------------------

# FORMAT HASIL

Untuk setiap aspek tampilkan tabel berikut:

| Aspek | Status |
|--------|--------|
| Sudah | ✅ |
| Sebagian | ⚠️ |
| Belum | ❌ |

Kemudian jelaskan:

- Bukti file yang diperiksa (path file dan fungsi/kelas terkait).
- Mengapa status tersebut diberikan.
- Risiko jika belum memenuhi.
- Prioritas perbaikan (Critical, High, Medium, Low).
- Rekomendasi teknis yang spesifik.

--------------------------------------------------

# SKOR

Di akhir berikan skor:

Security ........ /100

Performance .... /100

Scalability ..... /100

Availability .... /100

Reliability ..... /100

Maintainability . /100

Extensibility ... /100

Usability ....... /100

Accessibility ... /100

Compatibility ... /100

Portability ..... /100

Interoperability  /100

Observability ... /100

Testability ..... /100

Data Integrity .. /100

Data Privacy .... /100

Backup & Recovery /100

Fault Tolerance . /100

Auditability .... /100

Compliance ...... /100

Kemudian berikan:

- Nilai keseluruhan (/100).
- Daftar kekuatan utama proyek.
- Daftar kelemahan utama proyek.
- Daftar rekomendasi perbaikan yang diurutkan berdasarkan prioritas.

--------------------------------------------------

# PENTING

- Jangan mengarang.
- Jangan berasumsi.
- Jangan menyimpulkan tanpa membaca kode.
- Jika suatu fitur tidak ditemukan, tuliskan "Tidak ditemukan pada source code yang diperiksa".
- Sertakan path file sebagai bukti untuk setiap temuan.
- Jangan melakukan refactor atau perubahan kode pada tahap audit ini. Fokus hanya pada analisis dan evaluasi berdasarkan kondisi aktual proyek.