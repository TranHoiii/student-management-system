package com.studentmanagement.service;

import com.studentmanagement.entity.Subject;
import com.studentmanagement.repository.SubjectRepository;
import java.util.List;
import java.util.Optional;

public class SubjectService {
    private final SubjectRepository subjectRepository;

    public SubjectService() {
        this.subjectRepository = new SubjectRepository();
    }

    public SubjectService(SubjectRepository subjectRepository) {
        this.subjectRepository = subjectRepository;
    }

    public Subject addSubject(Subject subject) {
        validateSubject(subject);

        if (subjectRepository.findBySubjectCode(subject.getSubjectCode().trim()).isPresent()) {
            throw new RuntimeException("Subject code already exists: " + subject.getSubjectCode());
        }

        subject.setSubjectCode(subject.getSubjectCode().trim());
        subject.setSubjectName(subject.getSubjectName().trim());

        return subjectRepository.save(subject);
    }

    public Subject updateSubject(Subject subject) {
        if (subject.getId() == null) {
            throw new IllegalArgumentException("Subject ID must not be null.");
        }

        Subject existing = subjectRepository.findById(subject.getId())
                .orElseThrow(() -> new RuntimeException("Subject not found."));

        validateSubject(subject);

        String newCode = subject.getSubjectCode().trim();
        if (!existing.getSubjectCode().equalsIgnoreCase(newCode)) {
            Optional<Subject> duplicate = subjectRepository.findBySubjectCode(newCode);
            if (duplicate.isPresent() && !duplicate.get().getId().equals(subject.getId())) {
                throw new RuntimeException("Subject code already exists: " + newCode);
            }
        }

        existing.setSubjectCode(newCode);
        existing.setSubjectName(subject.getSubjectName().trim());
        existing.setCredits(subject.getCredits());

        return subjectRepository.update(existing);
    }

    public void deleteSubject(Long id) {
        subjectRepository.findById(id)
                .orElseThrow(() -> new RuntimeException("Subject not found."));
        subjectRepository.delete(id);
    }

    public Subject findSubjectByCode(String subjectCode) {
        if (subjectCode == null || subjectCode.trim().isEmpty()) {
            throw new IllegalArgumentException("Subject code cannot be empty.");
        }
        return subjectRepository.findBySubjectCode(subjectCode.trim())
                .orElseThrow(() -> new RuntimeException("Subject not found with code: " + subjectCode));
    }

    public List<Subject> getAllSubjects() {
        return subjectRepository.findAll();
    }

    private void validateSubject(Subject subject) {
        if (subject.getSubjectCode() == null || subject.getSubjectCode().trim().isEmpty()) {
            throw new IllegalArgumentException("Subject code cannot be empty.");
        }
        if (subject.getSubjectName() == null || subject.getSubjectName().trim().isEmpty()) {
            throw new IllegalArgumentException("Subject name cannot be empty.");
        }
        if (subject.getCredits() == null || subject.getCredits() <= 0) {
            throw new IllegalArgumentException("Credits must be greater than 0.");
        }
    }
}
