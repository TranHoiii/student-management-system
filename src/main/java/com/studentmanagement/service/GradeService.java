package com.studentmanagement.service;

import com.studentmanagement.entity.Grade;
import com.studentmanagement.entity.Student;
import com.studentmanagement.entity.Subject;
import com.studentmanagement.exception.InvalidScoreException;
import com.studentmanagement.exception.StudentNotFoundException;
import com.studentmanagement.repository.GradeRepository;
import com.studentmanagement.repository.StudentRepository;
import com.studentmanagement.repository.SubjectRepository;
import java.util.List;
import java.util.Optional;

public class GradeService {
    private final GradeRepository gradeRepository;
    private final StudentRepository studentRepository;
    private final SubjectRepository subjectRepository;

    public GradeService() {
        this.gradeRepository = new GradeRepository();
        this.studentRepository = new StudentRepository();
        this.subjectRepository = new SubjectRepository();
    }

    public GradeService(GradeRepository gradeRepository, StudentRepository studentRepository, SubjectRepository subjectRepository) {
        this.gradeRepository = gradeRepository;
        this.studentRepository = studentRepository;
        this.subjectRepository = subjectRepository;
    }

    public Grade addGrade(String studentCode, String subjectCode, Double score) {
        if (score == null || score < 0 || score > 10) {
            throw new InvalidScoreException("Score must be between 0 and 10.");
        }

        Student student = studentRepository.findByStudentCode(studentCode.trim())
                .orElseThrow(() -> new StudentNotFoundException("Student not found."));

        Subject subject = subjectRepository.findBySubjectCode(subjectCode.trim())
                .orElseThrow(() -> new RuntimeException("Subject not found."));

        // Check if grade already exists for this student and subject
        Optional<Grade> existing = gradeRepository.findByStudentAndSubject(student.getId(), subject.getId());
        if (existing.isPresent()) {
            throw new RuntimeException("Grade already exists for this subject. Use update grade instead.");
        }

        Grade grade = new Grade(student, subject, score);
        return gradeRepository.save(grade);
    }

    public Grade updateGrade(String studentCode, String subjectCode, Double newScore) {
        if (newScore == null || newScore < 0 || newScore > 10) {
            throw new InvalidScoreException("Score must be between 0 and 10.");
        }

        Student student = studentRepository.findByStudentCode(studentCode.trim())
                .orElseThrow(() -> new StudentNotFoundException("Student not found."));

        Subject subject = subjectRepository.findBySubjectCode(subjectCode.trim())
                .orElseThrow(() -> new RuntimeException("Subject not found."));

        Grade grade = gradeRepository.findByStudentAndSubject(student.getId(), subject.getId())
                .orElseThrow(() -> new RuntimeException("Grade not found."));

        grade.setScore(newScore);
        return gradeRepository.update(grade);
    }

    public void deleteGrade(String studentCode, String subjectCode) {
        Student student = studentRepository.findByStudentCode(studentCode.trim())
                .orElseThrow(() -> new StudentNotFoundException("Student not found."));

        Subject subject = subjectRepository.findBySubjectCode(subjectCode.trim())
                .orElseThrow(() -> new RuntimeException("Subject not found."));

        Grade grade = gradeRepository.findByStudentAndSubject(student.getId(), subject.getId())
                .orElseThrow(() -> new RuntimeException("Grade not found."));

        gradeRepository.delete(grade.getId());
    }

    public double calculateAverageScore(Student student) {
        List<Grade> grades = gradeRepository.findByStudent(student.getId());
        if (grades.isEmpty()) {
            return 0.0;
        }

        double totalWeightedScore = 0.0;
        int totalCredits = 0;

        for (Grade grade : grades) {
            int credits = grade.getSubject().getCredits();
            totalWeightedScore += grade.getScore() * credits;
            totalCredits += credits;
        }

        if (totalCredits == 0) {
            return 0.0;
        }

        double average = totalWeightedScore / totalCredits;
        // Round to 2 decimal places
        return Math.round(average * 100.0) / 100.0;
    }

    public String classifyStudent(Double gpa) {
        if (gpa == null || gpa < 0.0) {
            return "Poor";
        }
        if (gpa >= 8.5) {
            return "Excellent";
        } else if (gpa >= 7.0) {
            return "Good";
        } else if (gpa >= 5.0) {
            return "Average";
        } else {
            return "Poor";
        }
    }

    public List<Grade> getGradesByStudentCode(String studentCode) {
        Student student = studentRepository.findByStudentCode(studentCode.trim())
                .orElseThrow(() -> new StudentNotFoundException("Student not found."));
        return gradeRepository.findByStudent(student.getId());
    }
}
