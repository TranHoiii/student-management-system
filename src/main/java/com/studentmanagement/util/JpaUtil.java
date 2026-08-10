package com.studentmanagement.util;

import jakarta.persistence.EntityManagerFactory;
import jakarta.persistence.Persistence;
import java.io.IOException;
import java.io.InputStream;
import java.util.HashMap;
import java.util.Map;
import java.util.Properties;

public class JpaUtil {
    private static final EntityManagerFactory emf;

    static {
        Properties properties = new Properties();
        Map<String, String> overrides = new HashMap<>();
        
        // Load configurations from application.properties
        try (InputStream is = JpaUtil.class.getClassLoader().getResourceAsStream("application.properties")) {
            if (is != null) {
                properties.load(is);
                if (properties.getProperty("db.url") != null) {
                    overrides.put("jakarta.persistence.jdbc.url", properties.getProperty("db.url"));
                }
                if (properties.getProperty("db.username") != null) {
                    overrides.put("jakarta.persistence.jdbc.user", properties.getProperty("db.username"));
                }
                if (properties.getProperty("db.password") != null) {
                    overrides.put("jakarta.persistence.jdbc.password", properties.getProperty("db.password"));
                }
            }
        } catch (IOException e) {
            System.err.println("Warning: Could not load application.properties, using persistence.xml defaults.");
        }
        
        try {
            emf = Persistence.createEntityManagerFactory("student-management-persistence-unit", overrides);
        } catch (Throwable ex) {
            System.err.println("Error: Initial EntityManagerFactory creation failed. " + ex.getMessage());
            throw new ExceptionInInitializerError(ex);
        }
    }

    public static EntityManagerFactory getEntityManagerFactory() {
        return emf;
    }

    public static void shutdown() {
        if (emf != null && emf.isOpen()) {
            emf.close();
        }
    }
}
