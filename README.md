# Platform Pembelajaran Internal YPI Al-Azhar

Platform pembelajaran internal untuk meningkatkan kompetensi dan skill pegawai IT YPI Al-Azhar - Sebuah Learning Management System (LMS) berbasis web yang dirancang khusus untuk memberikan pelatihan dan pengembangan keterampilan kepada pegawai di lingkungan YPI Al-Azhar.

## 📋 Deskripsi

Platform ini adalah sistem manajemen pembelajaran yang memungkinkan pegawai untuk mengakses kursus pelatihan, melacak progress pembelajaran, berinteraksi melalui forum diskusi, dan meningkatkan kompetensi IT mereka secara terstruktur. Sistem ini juga menyediakan dashboard analytics untuk admin dan kontributor dalam mengelola konten pembelajaran.

## ✨ Fitur Utama

### Untuk Pegawai (User)
- 📚 **Browse & Enroll Kursus** - Melihat katalog kursus dan mendaftar ke kursus yang diminati
- 🎥 **Video Learning** - Pembelajaran berbasis video dengan fitur resume otomatis
- 📝 **Personal Notes** - Membuat catatan pribadi di setiap materi pembelajaran
- 📊 **Progress Tracking** - Monitoring progress pembelajaran secara real-time
- 💬 **Forum Diskusi** - Berdiskusi dan bertanya tentang materi pembelajaran
- ⭐ **Review & Rating** - Memberikan review dan rating untuk kursus yang telah diselesaikan
- 🏆 **Dashboard Pribadi** - Melihat semua kursus yang diikuti dan aktivitas pembelajaran
- 🔖 **Bookmarking** - Menyimpan posisi terakhir video yang ditonton

### Untuk Kontributor
- ✍️ **Membuat Kursus** - Membuat dan mengelola kursus pembelajaran sendiri
- 📑 **Manajemen Modul** - Mengorganisir materi dalam modul-modul terstruktur
- 🎬 **Manajemen Materi** - Menambahkan konten text, video, attachment, dan referensi
- 🔄 **Drag & Drop Reorder** - Mengatur ulang urutan modul dan materi dengan mudah
- 📤 **Publish/Unpublish** - Mengontrol status publikasi kursus
- 📈 **Analytics** - Melihat statistik dan performa kursus yang dibuat

### Untuk Admin
- 👥 **User Management** - Mengelola akun pegawai (CRUD operations)
- 📋 **Full Course Management** - Mengelola semua kursus dari semua kontributor
- 📊 **Advanced Analytics** - Dashboard analytics lengkap dengan metrics:
  - Popular courses
  - User activity tracking
  - Completion rate
  - Enrollment statistics
- 🔐 **Role Management** - Mengatur role (Admin, Kontributor, User)
- 👤 **Manual Registration** - Mendaftarkan pegawai baru secara manual

## 🛠️ Tech Stack

### Backend
- **Framework**: Laravel 12
- **Database**: MySQL
- **Authentication**: Laravel Breeze (customized)
- **ORM**: Eloquent
- **File Storage**: Laravel Storage (public disk)

### Frontend
- **Template Engine**: Blade
- **CSS Framework**: Tailwind CSS (assumed)
- **JavaScript**: Vanilla JS / Alpine.js (for interactivity)
- **AJAX**: Fetch API / Axios

### Additional Packages
- `cviebrock/eloquent-sluggable` - Auto slug generation
- Laravel Queue - Background job processing
- Laravel Cache - Performance optimization

## 📊 Struktur Database

### Core Tables

#### Users Management
- `users` - Data pegawai dengan role (admin, kontributor, user)
- `password_reset_tokens` - Token reset password
- `sessions` - Session management

#### Course Structure
- `courses` - Data kursus dengan metadata
- `modules` - Modul dalam kursus (ordered)
- `lessons` - Materi pembelajaran dalam modul (ordered)
- `lesson_attachments` - File attachment untuk materi
- `lesson_references` - Referensi eksternal (buku, artikel, dll)

#### User Interaction
- `enrollments` - Pendaftaran user ke kursus
- `user_progress` - Progress pembelajaran per materi
- `user_notes` - Catatan pribadi user
- `discussions` - Thread diskusi per materi
- `discussion_replies` - Balasan diskusi
- `course_reviews` - Review dan rating kursus

#### Analytics & Logging
- `user_activities` - Activity log dengan JSON data
- `cache` - Cache storage
- `jobs` - Queue management

### Key Relationships
```
Course (1) ─→ (N) Modules ─→ (N) Lessons
Course (N) ←→ (N) Users (via enrollments)
Lesson (1) ─→ (N) Attachments
Lesson (1) ─→ (N) References
Lesson (1) ─→ (N) Discussions ─→ (N) Replies
User (1) ─→ (N) Progress (per lesson)
User (1) ─→ (N) Notes (per lesson)
```

## 🎭 User Roles & Permissions

### Admin
- ✅ Semua akses penuh
- ✅ User management (CRUD)
- ✅ Mengelola semua kursus
- ✅ Akses analytics lengkap
- ✅ Registrasi pegawai baru

### Kontributor
- ✅ Membuat dan mengelola kursus sendiri
- ✅ Menambah modul dan materi
- ✅ Publish/unpublish kursus
- ✅ Melihat analytics kursus sendiri
- ❌ Tidak bisa mengelola user
- ❌ Tidak bisa mengelola kursus orang lain (kecuali admin)

### User (Pegawai)
- ✅ Browse dan enroll kursus
- ✅ Akses materi pembelajaran
- ✅ Membuat catatan pribadi
- ✅ Berdiskusi di forum
- ✅ Memberikan review
- ❌ Tidak bisa membuat kursus
- ❌ Tidak bisa akses admin panel

## 🚀 Instalasi

### Prerequisites
- PHP >= 8.2
- Composer
- MySQL >= 8.0
- Node.js & NPM (untuk asset compilation)
- Git

### Langkah Instalasi

1. **Clone Repository**
   ```bash
   git clone <repository-url>
   cd <project-folder>
   ```

2. **Install Dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database Configuration**
   
   Edit file `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=lms_ypi_alazhar
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Run Migrations**
   ```bash
   php artisan migrate
   ```

6. **Storage Link**
   ```bash
   php artisan storage:link
   ```

7. **Seed Database (Optional)**
   ```bash
   php artisan db:seed
   ```

8. **Compile Assets**
   ```bash
   npm run dev
   # atau untuk production
   npm run build
   ```

9. **Run Application**
   ```bash
   php artisan serve
   ```

   Akses aplikasi di: `http://localhost:8000`

## 📱 Fitur-Fitur Detail

### 1. Sistem Enrollment
- User dapat enroll ke kursus yang sudah dipublikasikan
- Validasi: kursus harus published
- Prevent duplicate enrollment
- Auto increment total enrolled
- Activity logging

### 2. Progress Tracking
- **Per-Lesson Progress**: Tracking completed/in-progress status
- **Video Position**: Menyimpan posisi terakhir video untuk resume
- **Course Completion**: Auto-calculate percentage
- **Completion Certificate**: Mark completed saat 100%

### 3. Learning Experience
- **Video Player**: Embed YouTube dengan tracking
- **Content Display**: Rich text content support
- **Attachments**: Download materi pendukung
- **References**: Link ke sumber belajar eksternal
- **Last Position**: Resume dari posisi terakhir

### 4. Forum Diskusi
- Thread diskusi per materi
- Pinned discussions support
- Reply threading
- Author display
- Activity tracking

### 5. Analytics Dashboard
- **Course Metrics**:
  - Total enrollments
  - Completion rate
  - Average progress
  - Popular courses ranking
  
- **User Activity**:
  - Activity type grouping
  - Time-based filtering (30 days)
  - User engagement metrics
  
- **Recent Activities**:
  - Latest enrollments
  - Recent completions

### 6. Content Management
- **WYSIWYG Editor** (untuk lesson content)
- **Drag & Drop Reordering** (modules & lessons)
- **Thumbnail Upload** (untuk courses)
- **Video URL Embed** (YouTube support)
- **File Attachments** (multiple files per lesson)
- **External References** (categorized: book, article, video, website)

## 🔐 Authentication & Authorization

### Login System
- **Flexible Login**: Support dengan Email atau Employee ID (NIP)
- **Role-based Redirect**:
  - Admin/Kontributor → `/admin/dashboard`
  - User → `/home`
- **Remember Me**: Session persistence
- **Session Security**: Auto regeneration

### Authorization Pattern
```php
Route Middleware → Admin Middleware → Controller Authorization
```

Example:
```php
// Route level
Route::middleware(['auth', 'admin'])

// Controller level
if (!auth()->user()->canManageCourse($course)) {
    abort(403);
}
```

## 📈 Business Logic Flow

### Enrollment to Completion Flow
```
1. User Browse Courses
   ↓
2. View Course Detail (modules, lessons, reviews)
   ↓
3. Enroll (create enrollment record)
   ↓
4. Access Lesson (update last_accessed_lesson_id)
   ↓
5. Watch Video (auto-save last_position every 5s)
   ↓
6. Complete Lesson (mark is_completed = true)
   ↓
7. System Calculates Progress (completed/total * 100)
   ↓
8. If 100% → Mark Course Complete (completed_at = now)
   ↓
9. Submit Review & Rating
   ↓
10. Course average_rating updated
```

### Content Creation Flow (Admin/Kontributor)
```
1. Create Course (status: draft)
   ↓
2. Add Modules (ordered sequence)
   ↓
3. Add Lessons to Modules (ordered within module)
   ↓
4. Add Content (text, video, attachments, references)
   ↓
5. Review & Preview
   ↓
6. Publish Course (status: published, published_at: now)
   ↓
7. Analytics Tracking Active
```

## 🎨 UI/UX Design Principles

- **Responsive Design**: Mobile-first approach
- **Intuitive Navigation**: Clear menu structure
- **Progress Indicators**: Visual progress bars
- **Loading States**: Skeleton screens / spinners
- **Toast Notifications**: Success/error feedback
- **Breadcrumbs**: Easy navigation tracking
- **Search & Filter**: Quick content discovery

## 📝 API Endpoints (AJAX)

### Progress Tracking
```javascript
POST /learn/progress
{
  lesson_id: 123,
  is_completed: true,
  last_position: 340 // in seconds
}
```

### Save Notes
```javascript
POST /learn/notes
{
  lesson_id: 123,
  note: "Catatan saya..."
}
```

### Reorder Modules
```javascript
POST /admin/modules/reorder
{
  modules: [
    { id: 1, order: 0 },
    { id: 2, order: 1 }
  ]
}
```

### Reorder Lessons
```javascript
POST /admin/lessons/reorder
{
  lessons: [
    { id: 10, order: 0 },
    { id: 11, order: 1 }
  ]
}
```

## 🔧 Configuration

### Queue Configuration
Untuk background processing (email, notifications):
```bash
php artisan queue:work
```

### Cache Configuration
Clear cache saat development:
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Storage Configuration
Public storage sudah di-link untuk akses file:
```
storage/app/public → public/storage
```

Upload locations:
- Course thumbnails: `storage/app/public/courses/thumbnails/`
- Lesson attachments: `storage/app/public/lessons/attachments/`

## 🧪 Testing

### Manual Testing Checklist

**Authentication:**
- [ ] Login dengan email
- [ ] Login dengan employee_id
- [ ] Role-based redirect
- [ ] Logout

**User Flow:**
- [ ] Browse courses
- [ ] Filter by level
- [ ] Search courses
- [ ] View course detail
- [ ] Enroll course
- [ ] Access lesson
- [ ] Watch video (resume)
- [ ] Complete lesson
- [ ] Add notes
- [ ] Create discussion
- [ ] Reply discussion
- [ ] Submit review

**Admin Flow:**
- [ ] Create course
- [ ] Add module
- [ ] Add lesson
- [ ] Reorder modules
- [ ] Reorder lessons
- [ ] Publish course
- [ ] View analytics
- [ ] Manage users

## 📊 Performance Optimization

### Implemented Optimizations
- **Eager Loading**: Prevent N+1 queries
  ```php
  ->with(['modules.lessons', 'creator', 'reviews.user'])
  ```

- **Pagination**: Limit result sets
  ```php
  ->paginate(12)
  ```

- **Indexing**: Database indexes on:
  - Foreign keys
  - Frequently queried columns (slug, status, etc.)
  - Composite indexes (course_id + order)

- **Denormalization**:
  - `total_enrolled` (instead of count query)
  - `average_rating` (pre-calculated)
  - `replies_count` (cached counter)

### Recommended Additional Optimizations
- Implement Redis caching for popular courses
- Use Laravel Horizon for queue monitoring
- Add CDN for static assets
- Database query optimization
- Image optimization (compression, lazy loading)

## 🐛 Known Issues & TODOs

### Current TODOs
```php
// In CourseController@publish
// TODO: Send notification to all users
// Notification::send(User::where('role', 'user')->get(), 
//                    new NewCoursePublished($course));
```

### Missing Features (Nice to Have)
- [ ] Lesson attachments upload controller
- [ ] Lesson references CRUD interface
- [ ] Discussion detail page
- [ ] User activity log viewer
- [ ] Certificate generation
- [ ] Email notifications
- [ ] Course categories/tags
- [ ] Advanced search with filters
- [ ] Bulk user import (CSV)
- [ ] Export course data
- [ ] Course cloning feature
- [ ] User badges/achievements
- [ ] Course prerequisites

## 🤝 Contributing

Panduan untuk kontributor:

1. Fork repository
2. Create feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to branch (`git push origin feature/AmazingFeature`)
5. Open Pull Request

### Coding Standards
- Follow PSR-12 coding style
- Use meaningful variable names
- Add comments for complex logic
- Write descriptive commit messages

## 📄 License

This project is proprietary software developed for internal use at YPI Al-Azhar.
All rights reserved © 2026 YPI Al-Azhar.

## 👨‍💻 Development Team

**Project Owner**: YPI Al-Azhar IT Department

**Tech Stack**:
- Laravel 12
- MySQL 8.0
- Tailwind CSS
- Alpine.js / JavaScript

## 📞 Support

Untuk bantuan atau pertanyaan, silakan hubungi:
- **IT Support**: it@ypi-alazhar.sch.id
- **Admin**: admin@ypi-alazhar.sch.id

---

**Last Updated**: January 2026
**Version**: 1.0.0
**Status**: In Development