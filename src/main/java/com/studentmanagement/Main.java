package com.studentmanagement;

import com.studentmanagement.entity.Grade;
import com.studentmanagement.entity.Student;
import com.studentmanagement.entity.Subject;
import com.studentmanagement.exception.DuplicateStudentException;
import com.studentmanagement.exception.InvalidScoreException;
import com.studentmanagement.exception.StudentNotFoundException;
import com.studentmanagement.service.GradeService;
import com.studentmanagement.service.StudentService;
import com.studentmanagement.service.SubjectService;
import com.studentmanagement.util.JpaUtil;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.time.LocalDate;
import java.time.format.DateTimeFormatter;
import java.time.format.DateTimeParseException;
import java.util.*;

public class Main {
    private static final BufferedReader reader = new BufferedReader(new InputStreamReader(System.in));
    private static final StudentService studentService = new StudentService();
    private static final SubjectService subjectService = new SubjectService();
    private static final GradeService gradeService = new GradeService();
    private static final DateTimeFormatter dateFormatter = DateTimeFormatter.ofPattern("yyyy-MM-dd");

    public static void main(String[] args) {
        System.out.println("Initializing Database Connection...");
        try {
            // Force JPA initialization
            JpaUtil.getEntityManagerFactory();
            System.out.println("Database initialized successfully!");
        } catch (Exception e) {
            System.err.println("Fatal Error: Could not connect to the database.");
            System.err.println("Please check application.properties or run database/student_management.sql.");
            e.printStackTrace();
            return;
        }

        boolean running = true;
        while (running) {
            printMenu();
            String choice = promptString("Choose an option: ").trim();
            System.out.println();
            try {
                switch (choice) {
                    case "1":
                        addStudent();
                        break;
                    case "2":
                        updateStudent();
                        break;
                    case "3":
                        deleteStudent();
                        break;
                    case "4":
                        findStudentByCode();
                        break;
                    case "5":
                        searchStudentByName();
                        break;
                    case "6":
                        displayAllStudents();
                        break;
                    case "7":
                        addGrade();
                        break;
                    case "8":
                        updateGrade();
                        break;
                    case "9":
                        deleteGrade();
                        break;
                    case "10":
                        viewStudentGpa();
                        break;
                    case "11":
                        displayRanking();
                        break;
                    case "0":
                        System.out.println("Closing database connections and exiting...");
                        JpaUtil.shutdown();
                        System.out.println("Goodbye!");
                        running = false;
                        break;
                    default:
                        System.out.println("Invalid option. Please choose a number between 0 and 11.");
                }
            } catch (StudentNotFoundException e) {
                System.out.println("Error: Student not found. " + e.getMessage());
            } catch (DuplicateStudentException e) {
                System.out.println("Error: Duplicate student entry. " + e.getMessage());
            } catch (InvalidScoreException e) {
                System.out.println("Error: Invalid score value. " + e.getMessage());
            } catch (Exception e) {
                System.out.println("An unexpected error occurred: " + e.getMessage());
            }
            System.out.println();
        }
    }

    private static void printMenu() {
        System.out.println("=====================================");
        System.out.println("       STUDENT MANAGEMENT SYSTEM     ");
        System.out.println("=====================================");
        System.out.println("1. Add student");
        System.out.println("2. Update student");
        System.out.println("3. Delete student");
        System.out.println("4. Find student by code");
        System.out.println("5. Search student by name");
        System.out.println("6. Display all students");
        System.out.println("7. Add grade");
        System.out.println("8. Update grade");
        System.out.println("9. Delete grade");
        System.out.println("10. View student GPA");
        System.out.println("11. Display ranking");
        System.out.println("0. Exit");
        System.out.println("=====================================");
    }

    // --- Action Methods ---

    private static void addStudent() {
        System.out.println("--- Add New Student ---");
        String code = promptStringRequired("Student Code: ");
        String name = promptStringRequired("Full Name: ");
        String email = promptString("Email (optional): ");
        String phone = promptString("Phone (optional): ");
        LocalDate dob = promptDate("Date of Birth (yyyy-MM-dd, optional): ");
        String major = promptString("Major (optional): ");

        Student student = new Student(code, name, email, phone, dob, major);
        studentService.addStudent(student);
        System.out.println("Student added successfully!");
    }

    private static void updateStudent() {
        System.out.println("--- Update Student Info ---");
        String code = promptStringRequired("Enter Student Code to update: ");
        Student existing = studentService.findStudentByCode(code);

        System.out.println("Student found: " + existing.getFullName());
        System.out.println("Press Enter to keep current value.");

        String newCode = promptString("New Student Code [" + existing.getStudentCode() + "]: ");
        if (!newCode.trim().isEmpty()) {
            existing.setStudentCode(newCode.trim());
        }

        String newName = promptString("New Full Name [" + existing.getFullName() + "]: ");
        if (!newName.trim().isEmpty()) {
            existing.setFullName(newName.trim());
        }

        String newEmail = promptString("New Email [" + existing.getEmail() + "]: ");
        if (!newEmail.trim().isEmpty()) {
            existing.setEmail(newEmail.trim());
        }

        String newPhone = promptString("New Phone [" + existing.getPhone() + "]: ");
        if (!newPhone.trim().isEmpty()) {
            existing.setPhone(newPhone.trim());
        }

        String currentDob = existing.getDateOfBirth() != null ? existing.getDateOfBirth().toString() : "N/A";
        LocalDate newDob = promptDate("New Date of Birth (yyyy-MM-dd) [" + currentDob + "]: ");
        if (newDob != null) {
            existing.setDateOfBirth(newDob);
        }

        String newMajor = promptString("New Major [" + existing.getMajor() + "]: ");
        if (!newMajor.trim().isEmpty()) {
            existing.setMajor(newMajor.trim());
        }

        studentService.updateStudent(existing);
        System.out.println("Student updated successfully!");
    }

    private static void deleteStudent() {
        System.out.println("--- Delete Student ---");
        String code = promptStringRequired("Enter Student Code to delete: ");
        Student student = studentService.findStudentByCode(code);

        System.out.println("Student details to delete:");
        System.out.println("Code: " + student.getStudentCode());
        System.out.println("Name: " + student.getFullName());
        System.out.println("Major: " + student.getMajor());

        String confirm = promptString("Are you sure you want to delete this student? (Y/N): ");
        if (confirm.equalsIgnoreCase("Y")) {
            studentService.deleteStudent(student.getId());
            System.out.println("Student deleted successfully!");
        } else {
            System.out.println("Deletion cancelled.");
        }
    }

    private static void findStudentByCode() {
        System.out.println("--- Find Student ---");
        String code = promptStringRequired("Enter Student Code: ");
        Student student = studentService.findStudentByCode(code);

        printStudentCard(student);
    }

    private static void searchStudentByName() {
        System.out.println("--- Search Student By Name ---");
        String keyword = promptStringRequired("Enter name keyword: ");
        List<Student> list = studentService.searchStudentByName(keyword);

        if (list.isEmpty()) {
            System.out.println("No students found matching the name.");
        } else {
            printStudentTable(list);
        }
    }

    private static void displayAllStudents() {
        System.out.println("--- All Students ---");
        List<Student> list = studentService.getAllStudents();
        if (list.isEmpty()) {
            System.out.println("No students registered in the database.");
        } else {
            printStudentTable(list);
        }
    }

    private static void addGrade() {
        System.out.println("--- Add Grade ---");
        String studentCode = promptStringRequired("Student Code: ");
        
        // Let's show subjects available to make it easier
        displaySubjectsList();
        
        String subjectCode = promptStringRequired("Subject Code: ");
        double score = promptDouble("Score (0.0 - 10.0): ");

        gradeService.addGrade(studentCode, subjectCode, score);
        System.out.println("Grade added successfully!");
    }

    private static void updateGrade() {
        System.out.println("--- Update Grade ---");
        String studentCode = promptStringRequired("Student Code: ");
        String subjectCode = promptStringRequired("Subject Code: ");
        double score = promptDouble("New Score (0.0 - 10.0): ");

        gradeService.updateGrade(studentCode, subjectCode, score);
        System.out.println("Grade updated successfully!");
    }

    private static void deleteGrade() {
        System.out.println("--- Delete Grade ---");
        String studentCode = promptStringRequired("Student Code: ");
        String subjectCode = promptStringRequired("Subject Code: ");

        String confirm = promptString("Are you sure you want to delete this grade? (Y/N): ");
        if (confirm.equalsIgnoreCase("Y")) {
            gradeService.deleteGrade(studentCode, subjectCode);
            System.out.println("Grade deleted successfully!");
        } else {
            System.out.println("Deletion cancelled.");
        }
    }

    private static void viewStudentGpa() {
        System.out.println("--- View Student GPA & Grades ---");
        String studentCode = promptStringRequired("Enter Student Code: ");
        Student student = studentService.findStudentByCode(studentCode);

        System.out.println("\n=======================================================");
        System.out.println("STUDENT ACADEMIC RECORD");
        System.out.println("=======================================================");
        System.out.println("Code:   " + student.getStudentCode());
        System.out.println("Name:   " + student.getFullName());
        System.out.println("Major:  " + student.getMajor());
        System.out.println("-------------------------------------------------------");

        List<Grade> grades = gradeService.getGradesByStudentCode(studentCode);
        if (grades.isEmpty()) {
            System.out.println("No graded subjects found for this student.");
        } else {
            System.out.printf("| %-12s | %-30s | %-7s | %-5s |\n", "Subject Code", "Subject Name", "Credits", "Score");
            System.out.println("+--------------+--------------------------------+---------+-------+");
            for (Grade g : grades) {
                System.out.printf("| %-12s | %-30s | %-7d | %-5.1f |\n",
                        g.getSubject().getSubjectCode(),
                        g.getSubject().getSubjectName(),
                        g.getSubject().getCredits(),
                        g.getScore());
            }
            System.out.println("-------------------------------------------------------");
        }

        double gpa = gradeService.calculateAverageScore(student);
        String classification = gradeService.classifyStudent(gpa);
        
        if (grades.isEmpty()) {
            System.out.println("GPA: N/A");
            System.out.println("Academic Ranking: N/A");
        } else {
            System.out.printf("GPA (Weighted by Credits): %.2f\n", gpa);
            System.out.printf("Academic Classification:    %s\n", classification);
        }
        System.out.println("=======================================================");
    }

    private static void displayRanking() {
        System.out.println("--- Student Ranking (Sorted by GPA Descending) ---");
        List<Student> students = studentService.getAllStudents();
        if (students.isEmpty()) {
            System.out.println("No students registered.");
            return;
        }

        // Holder for student ranking information
        class StudentRank {
            final Student student;
            final double gpa;
            final String ranking;
            final int totalCredits;

            StudentRank(Student student, double gpa, String ranking, int totalCredits) {
                this.student = student;
                this.gpa = gpa;
                this.ranking = ranking;
                this.totalCredits = totalCredits;
            }
        }

        List<StudentRank> rankList = new ArrayList<>();
        for (Student s : students) {
            double gpa = gradeService.calculateAverageScore(s);
            String rank = gradeService.classifyStudent(gpa);
            // Calculate total credits to display
            int credits = 0;
            List<Grade> grades = gradeService.getGradesByStudentCode(s.getStudentCode());
            for (Grade g : grades) {
                credits += g.getSubject().getCredits();
            }
            // If student has no grades, classification is N/A or Poor
            String displayRank = grades.isEmpty() ? "N/A" : rank;
            double displayGpa = grades.isEmpty() ? -1.0 : gpa; // for sorting
            rankList.add(new StudentRank(s, displayGpa, displayRank, credits));
        }

        // Sort by GPA descending
        rankList.sort((r1, r2) -> Double.compare(r2.gpa, r1.gpa));

        // Display ranking board
        System.out.println("+------+--------------+--------------------+--------------+--------+-------------+");
        System.out.printf("| %-4s | %-12s | %-18s | %-12s | %-6s | %-11s |\n", "Rank", "Code", "Name", "Major", "GPA", "Ranking");
        System.out.println("+------+--------------+--------------------+--------------+--------+-------------+");
        int rankIndex = 1;
        for (StudentRank sr : rankList) {
            String gpaStr = sr.gpa < 0 ? "N/A" : String.format("%.2f", sr.gpa);
            System.out.printf("| %-4d | %-12s | %-18s | %-12s | %-6s | %-11s |\n",
                    rankIndex++,
                    sr.student.getStudentCode(),
                    limitString(sr.student.getFullName(), 18),
                    limitString(sr.student.getMajor() != null ? sr.student.getMajor() : "N/A", 12),
                    gpaStr,
                    sr.ranking);
        }
        System.out.println("+------+--------------+--------------------+--------------+--------+-------------+");
    }

    private static void displaySubjectsList() {
        try {
            List<Subject> subjects = subjectService.getAllSubjects();
            System.out.println("Available subjects (Code - Name - Credits):");
            for (Subject sub : subjects) {
                System.out.printf("  [%s] %s (%d credits)\n", sub.getSubjectCode(), sub.getSubjectName(), sub.getCredits());
            }
        } catch (Exception e) {
            // Ignore if error displaying subjects
        }
    }

    // --- Helper Methods ---

    private static String promptString(String message) {
        System.out.print(message);
        return readLine();
    }

    private static String promptStringRequired(String message) {
        while (true) {
            System.out.print(message);
            String input = readLine().trim();
            if (!input.isEmpty()) {
                return input;
            }
            System.out.println("This field is required. Please try again.");
        }
    }

    private static double promptDouble(String message) {
        while (true) {
            System.out.print(message);
            String input = readLine().trim();
            try {
                return Double.parseDouble(input);
            } catch (NumberFormatException e) {
                System.out.println("Invalid numeric input. Please try again.");
            }
        }
    }

    private static LocalDate promptDate(String message) {
        while (true) {
            System.out.print(message);
            String input = readLine().trim();
            if (input.isEmpty()) {
                return null;
            }
            try {
                return LocalDate.parse(input, dateFormatter);
            } catch (DateTimeParseException e) {
                System.out.println("Invalid date format (must be yyyy-MM-dd). Please try again.");
            }
        }
    }

    private static String readLine() {
        try {
            return reader.readLine();
        } catch (IOException e) {
            return "";
        }
    }

    private static void printStudentCard(Student s) {
        System.out.println("==================================================");
        System.out.println("STUDENT DETAILS");
        System.out.println("==================================================");
        System.out.println("ID:            " + s.getId());
        System.out.println("Student Code:  " + s.getStudentCode());
        System.out.println("Full Name:     " + s.getFullName());
        System.out.println("Email:         " + (s.getEmail() != null ? s.getEmail() : "N/A"));
        System.out.println("Phone:         " + (s.getPhone() != null ? s.getPhone() : "N/A"));
        System.out.println("Date of Birth: " + (s.getDateOfBirth() != null ? s.getDateOfBirth() : "N/A"));
        System.out.println("Major:         " + (s.getMajor() != null ? s.getMajor() : "N/A"));
        System.out.println("==================================================");
    }

    private static void printStudentTable(List<Student> students) {
        System.out.println("+--------------+----------------------+----------------------+------------+------------+------------------------+");
        System.out.printf("| %-12s | %-20s | %-20s | %-10s | %-10s | %-22s |\n",
                "Student Code", "Full Name", "Email", "Phone", "DOB", "Major");
        System.out.println("+--------------+----------------------+----------------------+------------+------------+------------------------+");
        for (Student s : students) {
            String dob = s.getDateOfBirth() != null ? s.getDateOfBirth().toString() : "N/A";
            System.out.printf("| %-12s | %-20s | %-20s | %-10s | %-10s | %-22s |\n",
                    s.getStudentCode(),
                    limitString(s.getFullName(), 20),
                    limitString(s.getEmail() != null ? s.getEmail() : "N/A", 20),
                    limitString(s.getPhone() != null ? s.getPhone() : "N/A", 10),
                    dob,
                    limitString(s.getMajor() != null ? s.getMajor() : "N/A", 22));
        }
        System.out.println("+--------------+----------------------+----------------------+------------+------------+------------------------+");
    }

    private static String limitString(String str, int limit) {
        if (str == null) return "";
        if (str.length() <= limit) return str;
        return str.substring(0, limit - 3) + "...";
    }
}
