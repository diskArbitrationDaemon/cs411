//import java.io.BufferedWriter;
import java.io.*;
import java.net.URL;
import java.util.Vector;
import java.sql.*;

public class parserApp {

	private static void initUIUC(File file1, String url1) throws IOException, ClassNotFoundException {
		file1.createNewFile();
		
		FileOutputStream fstream = new FileOutputStream(file1);
		DataOutputStream out = new DataOutputStream(fstream);
		BufferedWriter writer = new BufferedWriter(new OutputStreamWriter(out)); 		  
		
			
		HTMLparser parseUIUC = new HTMLparser(url1, 0);
		
		Vector<CourseSubject> coursesUIUC = parseUIUC.getCourses();
		
		//HTMLparser.cleanData(coursesUIUC, 1);
		/*
		for(int i = 0; i < coursesUIUC.size(); ++i){
			writer.write(coursesUIUC.get(i).getTitle());
			writer.newLine();
		}
		*/
		
		
		for(int i = 0; i < coursesUIUC.size(); ++i)
		{
			if (coursesUIUC.get(i).getTitle().equals("Computer Science"))
			{
				parseUIUC.assignClasses_UIUC(coursesUIUC.get(i));
				for (int j = 0; j < coursesUIUC.get(i).getCoursesSize(); j++)
				{
					String courseName = coursesUIUC.get(i).getItem(j);
					String moddedCourseName = courseName.replace(" ", "_");
					
					writer.write(moddedCourseName);
					writer.newLine();
				}
			}	
		}
		
		writer.close();
	}
	
	private static void initLinkedCourses() throws IOException, ClassNotFoundException{
		File file1 = new File("./UIUCcourses_Fall11.txt");
		String url1 = "http://courses.illinois.edu/cis/2011/spring/catalog/index.html";
		initUIUC(file1, url1);
		
		File file2 = new File("./UIUCcourses_Spring12.txt");
		String url2 = "http://courses.illinois.edu/cis/2012/spring/catalog/index.html";
		initUIUC(file2, url2);
	}

	public static void main(String[] args) throws IOException, ClassNotFoundException {
			parserApp.initLinkedCourses();
	}

}
