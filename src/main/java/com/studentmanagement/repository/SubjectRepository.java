package com.studentmanagement.repository;

import com.studentmanagement.entity.Subject;
import com.studentmanagement.util.JpaUtil;
import jakarta.persistence.EntityManager;
import jakarta.persistence.EntityTransaction;
import jakarta.persistence.NoResultException;
import java.util.List;
import java.util.Optional;

public class SubjectRepository {

    public Subject save(Subject subject) {
        EntityManager em = JpaUtil.getEntityManagerFactory().createEntityManager();
        EntityTransaction tx = em.getTransaction();
        try {
            tx.begin();
            em.persist(subject);
            tx.commit();
            return subject;
        } catch (Exception e) {
            if (tx.isActive()) {
                tx.rollback();
            }
            throw e;
        } finally {
            em.close();
        }
    }

    public Subject update(Subject subject) {
        EntityManager em = JpaUtil.getEntityManagerFactory().createEntityManager();
        EntityTransaction tx = em.getTransaction();
        try {
            tx.begin();
            Subject updated = em.merge(subject);
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
            Subject subject = em.find(Subject.class, id);
            if (subject != null) {
                em.remove(subject);
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

    public Optional<Subject> findById(Long id) {
        EntityManager em = JpaUtil.getEntityManagerFactory().createEntityManager();
        try {
            Subject subject = em.find(Subject.class, id);
            return Optional.ofNullable(subject);
        } finally {
            em.close();
        }
    }

    public Optional<Subject> findBySubjectCode(String subjectCode) {
        EntityManager em = JpaUtil.getEntityManagerFactory().createEntityManager();
        try {
            Subject subject = em.createQuery(
                    "SELECT s FROM Subject s WHERE s.subjectCode = :subjectCode", Subject.class)
                    .setParameter("subjectCode", subjectCode)
                    .getSingleResult();
            return Optional.of(subject);
        } catch (NoResultException e) {
            return Optional.empty();
        } finally {
            em.close();
        }
    }

    public List<Subject> findAll() {
        EntityManager em = JpaUtil.getEntityManagerFactory().createEntityManager();
        try {
            return em.createQuery("SELECT s FROM Subject s", Subject.class).getResultList();
        } finally {
            em.close();
        }
    }
}
