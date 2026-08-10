package com.studentmanagement.repository;

import com.studentmanagement.entity.Grade;
import com.studentmanagement.util.JpaUtil;
import jakarta.persistence.EntityManager;
import jakarta.persistence.EntityTransaction;
import jakarta.persistence.NoResultException;
import java.util.List;
import java.util.Optional;

public class GradeRepository {

    public Grade save(Grade grade) {
        EntityManager em = JpaUtil.getEntityManagerFactory().createEntityManager();
        EntityTransaction tx = em.getTransaction();
        try {
            tx.begin();
            // Merge to make sure student and subject are in persistent state if they are detached
            if (grade.getStudent() != null && grade.getStudent().getId() != null) {
                grade.setStudent(em.merge(grade.getStudent()));
            }
            if (grade.getSubject() != null && grade.getSubject().getId() != null) {
                grade.setSubject(em.merge(grade.getSubject()));
            }
            em.persist(grade);
            tx.commit();
            return grade;
        } catch (Exception e) {
            if (tx.isActive()) {
                tx.rollback();
            }
            throw e;
        } finally {
            em.close();
        }
    }

    public Grade update(Grade grade) {
        EntityManager em = JpaUtil.getEntityManagerFactory().createEntityManager();
        EntityTransaction tx = em.getTransaction();
        try {
            tx.begin();
            Grade updated = em.merge(grade);
            tx.commit();
            return updated;
        } catch (Exception e) {
            if (tx.isActive()) {
                tx.rollback();
            }
            throw e;
        } finally {
            em.close();
        }
    }

    public void delete(Long id) {
        EntityManager em = JpaUtil.getEntityManagerFactory().createEntityManager();
        EntityTransaction tx = em.getTransaction();
        try {
            tx.begin();
            Grade grade = em.find(Grade.class, id);
            if (grade != null) {
                em.remove(grade);
            }
            tx.commit();
        } catch (Exception e) {
            if (tx.isActive()) {
                tx.rollback();
            }
            throw e;
        } finally {
            em.close();
        }
    }

    public Optional<Grade> findById(Long id) {
        EntityManager em = JpaUtil.getEntityManagerFactory().createEntityManager();
        try {
            Grade grade = em.find(Grade.class, id);
            return Optional.ofNullable(grade);
        } finally {
            em.close();
        }
    }

    public List<Grade> findByStudent(Long studentId) {
        EntityManager em = JpaUtil.getEntityManagerFactory().createEntityManager();
        try {
            // Using JOIN FETCH to load subjects eagerly and avoid lazy loading issues
            return em.createQuery(
                    "SELECT g FROM Grade g JOIN FETCH g.subject WHERE g.student.id = :studentId", Grade.class)
                    .setParameter("studentId", studentId)
                    .getResultList();
        } finally {
            em.close();
        }
    }

    public Optional<Grade> findByStudentAndSubject(Long studentId, Long subjectId) {
        EntityManager em = JpaUtil.getEntityManagerFactory().createEntityManager();
        try {
            Grade grade = em.createQuery(
                    "SELECT g FROM Grade g WHERE g.student.id = :studentId AND g.subject.id = :subjectId", Grade.class)
                    .setParameter("studentId", studentId)
                    .setParameter("subjectId", subjectId)
                    .getSingleResult();
            return Optional.of(grade);
        } catch (NoResultException e) {
            return Optional.empty();
        } finally {
            em.close();
        }
    }
}
