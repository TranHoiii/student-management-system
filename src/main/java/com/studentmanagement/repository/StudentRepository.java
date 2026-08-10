package com.studentmanagement.repository;

import com.studentmanagement.entity.Student;
import com.studentmanagement.util.JpaUtil;
import jakarta.persistence.EntityManager;
import jakarta.persistence.EntityTransaction;
import jakarta.persistence.NoResultException;
import java.util.List;
import java.util.Optional;

public class StudentRepository {

    public Student save(Student student) {
        EntityManager em = JpaUtil.getEntityManagerFactory().createEntityManager();
        EntityTransaction tx = em.getTransaction();
        try {
            tx.begin();
            em.persist(student);
            tx.commit();
            return student;
        } catch (Exception e) {
            if (tx.isActive()) {
                tx.rollback();
            }
            throw e;
        } finally {
            em.close();
        }
    }

    public Student update(Student student) {
        EntityManager em = JpaUtil.getEntityManagerFactory().createEntityManager();
        EntityTransaction tx = em.getTransaction();
        try {
            tx.begin();
            Student updated = em.merge(student);
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
            Student student = em.find(Student.class, id);
            if (student != null) {
                em.remove(student);
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

    public Optional<Student> findById(Long id) {
        EntityManager em = JpaUtil.getEntityManagerFactory().createEntityManager();
        try {
            Student student = em.find(Student.class, id);
            return Optional.ofNullable(student);
        } finally {
            em.close();
        }
    }

    public Optional<Student> findByStudentCode(String studentCode) {
        EntityManager em = JpaUtil.getEntityManagerFactory().createEntityManager();
        try {
            Student student = em.createQuery(
                    "SELECT s FROM Student s WHERE s.studentCode = :studentCode", Student.class)
                    .setParameter("studentCode", studentCode)
                    .getSingleResult();
            return Optional.of(student);
        } catch (NoResultException e) {
            return Optional.empty();
        } finally {
            em.close();
        }
    }

    public List<Student> findByName(String name) {
        EntityManager em = JpaUtil.getEntityManagerFactory().createEntityManager();
        try {
            return em.createQuery(
                    "SELECT s FROM Student s WHERE LOWER(s.fullName) LIKE LOWER(:name)", Student.class)
                    .setParameter("name", "%" + name + "%")
                    .getResultList();
        } finally {
            em.close();
        }
    }

    public List<Student> findAll() {
        EntityManager em = JpaUtil.getEntityManagerFactory().createEntityManager();
        try {
            return em.createQuery("SELECT s FROM Student s", Student.class).getResultList();
        } finally {
            em.close();
        }
    }
}
