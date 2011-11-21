

import java.net.URL;
import java.util.Vector;



public class CourseSubject {

	private String title;
	private Vector<String> courses;
	private URL url;
	
	public CourseSubject(String t, Vector<String> c){
		title = t;
		courses = c;
		url = null;
	}
	
	public void addCourse(String course){
		if(courses == null)
			courses = new Vector<String>();
		courses.add(course);
	}
	
	public String getTitle(){
		return title;
	}
	
	public URL getURL(){
		return url;
	}
	public String getItem(int index){
		if(courses == null)
			return null;
		return courses.get(index);
	}
	
	public int getCoursesSize(){
		if(courses == null)
			return 0;
		return courses.size();
	}
	
	public void setTitle(String str){
		title = str;
	}
	
	public void setURL(URL address){
		url = address;
	}
	
}
