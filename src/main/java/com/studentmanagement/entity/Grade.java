package com.studentmanagement.entity;

import jakarta.persistence.*;
import java.util.Objects;

@Entity
@Table(name = "grades", uniqueConstraints = {
    @UniqueConstraint(columnNames = {"student_id", "subject_id"})
})
public class Grade {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    @ManyToOne(fetch = FetchType.LAZY)
    @JoinColumn(name = "student_id", nullable = false)
    private Student student;

    @ManyToOne(fetch = FetchType.LAZY)
    @JoinColumn(name = "subject_id", nullable = false)
    private Subject subject;

    @Column(nullable = false)
    private Double score;

    // Default constructor required by JPA
    public Grade() {
    }

    // Constructor with fields
    public Grade(Student student, Subject subject, Double score) {
        this.student = student;
        this.subject = subject;
        this.score = score;
    }

    // Getters and Setters
    public Long getId() {
        return id;
    }

    public void setId(Long id) {
        this.id = id;
    }

    public Student getStudent() {
        return student;
    }

    public void setStudent(Student student) {
        this.student = student;
    }

    public Subject getSubject() {
        return subject;
    }

    public void setSubject(Subject subject) {
        this.subject = subject;
    }

    public Double getScore() {
        return score;
    }

    public void setScore(Double score) {
        this.score = score;
    }

    // Equals and hashCode based on student and subject association
    @Override
    public boolean equals(Object o) {
        if (this == o) return true;
        if (o == null || getClass() != o.getClass()) return false;
        Grade grade = (Grade) o;
        return Objects.equals(student, grade.student) &&
               Objects.equals(subject, grade.subject);
    }

    @Override
    public int hashCode() {
        return Objects.hash(student, subject);
    }

    @Override
    public String toString() {
        return "Grade{" +
                "id=" + id +
                ", score=" + score +
                '}';
    }
}
