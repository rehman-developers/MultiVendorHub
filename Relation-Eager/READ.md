
---

````markdown
# 🧠 Laravel Relationships & Eager Loading Guide

## 📘 Introduction
Laravel’s Eloquent ORM (Object Relational Mapper) provides an elegant way to manage and interact with your database.  
With Eloquent, you can define **relationships** between models such as **One to One**, **One to Many**, and **Many to Many**.

**Eager Loading** is a technique used to improve performance — it loads related data in **a single query**, preventing multiple database hits (known as the N+1 problem).

---

## 🎓 Real-Life Example

Imagine a school system where:
- A **Teacher** can teach multiple **Subjects**.
- A **Student** can study multiple **Subjects**.
- There is a **Many-to-Many** relationship between **Teachers** and **Subjects**.

---

## 🏗️ Database Structure

| Table Name | Relationship |
|-------------|--------------|
| `teachers`  | Has many subjects (via pivot table) |
| `students`  | Has many subjects (via pivot table) |
| `subjects`  | Belongs to many teachers & students |
| `subject_teacher` | Pivot table linking teachers and subjects |

---

## ⚙️ Step 1: Migration Setup

### 🧑‍🏫 Teachers Table
```php
Schema::create('teachers', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->timestamps();
});
````

### 📚 Subjects Table

```php
Schema::create('subjects', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->timestamps();
});
```

### 🔗 Pivot Table (subject_teacher)

```php
Schema::create('subject_teacher', function (Blueprint $table) {
    $table->id();
    $table->foreignId('teacher_id')->constrained()->onDelete('cascade');
    $table->foreignId('subject_id')->constrained()->onDelete('cascade');
    $table->timestamps();
});
```

---

## ⚙️ Step 2: Model Relationships

### 🧑‍🏫 `Teacher.php`

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = ['name'];

    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }
}
```

### 📚 `Subject.php`

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['title'];

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class);
    }
}
```

---

## ⚙️ Step 3: Eager Loading Example

### 🧾 Controller Code

```php
use App\Models\Teacher;

public function index()
{
    // Load all teachers with their related subjects in one query
    $teachers = Teacher::with('subjects')->get();

    return view('teachers.index', compact('teachers'));
}
```

### 📄 Blade View Example

```html
@foreach($teachers as $teacher)
    <h3>{{ $teacher->name }}</h3>
    <ul>
        @foreach($teacher->subjects as $subject)
            <li>{{ $subject->title }}</li>
        @endforeach
    </ul>
@endforeach
```

---

## 🚀 Example Output

```
Teacher: Mr. Ali
  - Subject: Mathematics
  - Subject: Physics

Teacher: Ms. Sara
  - Subject: English
  - Subject: History
```

---

## 💡 Why Use Eager Loading?

### ❌ Without Eager Loading

Laravel will run multiple queries (one for each teacher):

```sql
SELECT * FROM teachers;
SELECT * FROM subjects WHERE teacher_id = 1;
SELECT * FROM subjects WHERE teacher_id = 2;
...
```

This is known as the **N+1 problem**.

---

### ✅ With Eager Loading

Laravel fetches all the data in **a single optimized query**:

```sql
SELECT * FROM teachers;
SELECT * FROM subjects WHERE teacher_id IN (1, 2, 3);
```

⚡ **Faster and more efficient performance!**

---

## 🧩 Types of Relationships

| Relationship Type | Example            | Description                                                                     |
| ----------------- | ------------------ | ------------------------------------------------------------------------------- |
| **One to One**    | User → Profile     | A user has exactly one profile                                                  |
| **One to Many**   | Teacher → Students | A teacher can have many students                                                |
| **Many to Many**  | Teacher ↔ Subject  | A teacher can teach many subjects, and a subject can be taught by many teachers |

---

## 🧱 Real-Life Analogy

| Real Life Scenario                            | Laravel Relationship |
| --------------------------------------------- | -------------------- |
| A person has one passport                     | One to One           |
| A school has many students                    | One to Many          |
| Students and Subjects are connected both ways | Many to Many         |

---

## ✅ Summary

| Concept              | Purpose                                              |
| -------------------- | ---------------------------------------------------- |
| **Relationship**     | Defines logical connection between tables            |
| **Eager Loading**    | Loads related data in a single query                 |
| **Pivot Table**      | Acts as a bridge for many-to-many relationships      |
| **Performance Gain** | Eager loading reduces the number of database queries |

---

## 🧩 Common Artisan Commands

```bash
# Run all migrations
php artisan migrate

# Seed sample data into database
php artisan db:seed

# Reset and reseed database (if duplicate entries appear)
php artisan migrate:fresh --seed
```

---

## ✨ Author

**Abdul Rehman**
*This guide explains Laravel Relationships & Eager Loading in simple, real-world language.*

---

