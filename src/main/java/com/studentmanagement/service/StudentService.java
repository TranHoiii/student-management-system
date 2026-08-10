package com.studentmanagement.service;

import com.studentmanagement.entity.Student;
import com.studentmanagement.exception.DuplicateStudentException;
import com.studentmanagement.exception.StudentNotFoundException;
import com.studentmanagement.repository.StudentRepository;
import java.util.List;
import java.util.Optional;

public class StudentService {
    private final StudentRepository studentRepository;

    public StudentService() {
        this.studentRepository = new StudentRepository();
    }

    public StudentService(StudentRepository studentRepository) {
        this.studentRepository = studentRepository;
    }

    public Student addStudent(Student student) {
        validateStudent(student);

        // Check if student code already exists
        if (studentRepository.findByStudentCode(student.getStudentCode().trim()).isPresent()) {
            throw new DuplicateStudentException("Student code already exists.");
        }

        student.setStudentCode(student.getStudentCode().trim());
        student.setFullName(student.getFullName().trim());
        if (student.getEmail() != null) student.setEmail(student.getEmail().trim());
        if (student.getPhone() != null) student.setPhone(student.getPhone().trim());
        if (student.getMajor() != null) student.setMajor(student.getMajor().trim());

        return studentRepository.save(student);
    }

    public Student updateStudent(Student student) {
        if (student.getId() == null) {
            throw new IllegalArgumentException("Student ID must not be null.");
        }

        Student existing = studentRepository.findById(student.getId())
                .orElseThrow(() -> new StudentNotFoundException("Student not found."));

        validateStudent(student);

        // Check if student code has changed and conflicts with another student
        String newCode = student.getStudentCode().trim();
        if (!existing.getStudentCode().equalsIgnoreCase(newCode)) {
            Optional<Student> duplicate = studentRepository.findByStudentCode(newCode);
            if (duplicate.isPresent() && !duplicate.get().getId().equals(student.getId())) {
                throw new DuplicateStudentException("Student code already exists.");
            }
        }

        existing.setStudentCode(newCode);
        existing.setFullName(student.getFullName().trim());
        existing.setEmail(student.getEmail() != null ? student.getEmail().trim() : null);
        existing.setPhone(student.getPhone() != null ? student.getPhone().trim() : null);
        existing.setDateOfBirth(student.getDateOfBirth());
        existing.setMajor(student.getMajor() != null ? student.getMajor().trim() : null);

        return studentRepository.update(existing);
    }

    public void deleteStudent(Long id) {
        studentRepository.findById(id)
                .orElseThrow(() -> new StudentNotFoundException("Student not found."));
        studentRepository.delete(id);
    }

    public Student findStudentByCode(String studentCode) {
        if (studentCode == null || studentCode.trim().isEmpty()) {
            throw new IllegalArgumentException("Student code cannot be empty.");
        }
        return studentRepository.findByStudentCode(studentCode.trim())
                .orElseThrow(() -> new StudentNotFoundException("Student not found."));
    }

    public List<Student> searchStudentByName(String name) {
        if (name == null || name.trim().isEmpty()) {
            return studentRepository.findAll();
        }
        return studentRepository.findByName(name.trim());
    }

    public List<Student> getAllStudents() {
        return studentRepository.findAll();
    }

    private void validateStudent(Student student) {
        if (student.getStudentCode() == null || student.getStudentCode().trim().isEmpty()) {
            throw new IllegalArgumentException("Student code cannot be empty.");
        }
        if (student.getFullName() == null || student.getFullName().trim().isEmpty()) {
            throw new IllegalArgumentException("Full name cannot be empty.");
        }
    }
}
