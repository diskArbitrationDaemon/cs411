
import java.net.*;
import java.io.*;
import java.util.Vector;
import java.util.regex.Matcher;
import java.util.regex.Pattern;



public class HTMLparser {
	private URL address;
	private int flag;

	/* Constructor */
	public HTMLparser(String s, int pflag) throws MalformedURLException{
		address = new URL(s);
		flag = pflag;
	}
	
	/*
	 * 	getCourses():
	 * 			Returns a vector of courses
	 */
	public Vector<CourseSubject> getCourses() throws IOException{

		Vector<CourseSubject> coursesVector = new Vector<CourseSubject>();	
		String sourceLine = "";
		String content = "";	
		
		InputStreamReader pageInput = new InputStreamReader(address.openStream());
		BufferedReader source = new BufferedReader(pageInput);
		while( (sourceLine = source.readLine()) != null){
			content += sourceLine + "\n";
		}
		Pattern style = null;
		Pattern p = null;
		String regex0 = "";		// required for the split
		String regex1 = "";		// required for the split
		
		switch (flag) {	// dependent on different schools
        	case 0:
        		regex0 = "<div class=\"ws-course-title\"><a href.*?>";
        		style = Pattern.compile("<div class=\"ws-course-title\"><a href.*?>.*?</a></div>");
        		p = Pattern.compile("<a href=\".*?skinId=2169\">");
        		regex1 = "</a></div>";
        	break;
        }
		

        Matcher mstyle = style.matcher(content);
        String address = null;
        Matcher pstyle = null;
        if( p != null)
        	pstyle = p.matcher(content);
        
        String tag = "";
        String[] str = null;
        // need to change counter for Stanford mstyle has more values then pstyle
        int counter = 0;
        boolean done = false;
        while (mstyle.find() ){
        	done = pstyle.find();
        	tag = mstyle.group();
        	str = tag.split(regex0, 3);
        	if(str.length != 1)
        		str = str[str.length-1].split(regex1, 3);		// str[0] holds the name of the course
        	CourseSubject courseSub = new CourseSubject(str[0], null);		// no subclasses yet.
        	
        	if(flag == 3){		// for berkeley
        		address = str[0].trim().replace(' ', '+');
        		address = cleanURL(address, flag);
        	}
        	else{
        		if(flag == 2 && (counter < 9 || !done) )	// done for stanford
        			address = "http://www.fail.com";	// fail  this will be removed in linkedcoursesApp
        		else
        			address = pstyle.group();
        		address = cleanURL(address, flag);
        	}
        	courseSub.setURL(new URL(address));
        	
        	coursesVector.add(courseSub);
        	counter++;
        }
        
		pageInput.close();
		source.close();
		return coursesVector;
	}
	
	
	private String cleanURL(String address, int flag){

		String cleanedURL = null;
		
		switch (flag) {
			case 0:
				cleanedURL = address.substring(9, address.length()-3);
				cleanedURL = "http://" + this.address.getHost() +  
				this.address.getPath().substring(0, this.address.getPath().length() - 11) + "/" + cleanedURL;
			break;
			case 1:
				cleanedURL = address.substring(9, address.length()-2);
				cleanedURL = "http://" + this.address.getHost() +
				this.address.getPath().substring(0, this.address.getPath().length() - 10) + "/" + cleanedURL;
			break;
			case 2:
				cleanedURL = address.substring(9, address.length()-2);
				cleanedURL = "http://" + this.address.getHost() + this.address.getPath() + "/" + cleanedURL;
			break;
			case 3:
				cleanedURL = "http://osoc.berkeley.edu/OSOC/osoc?y=7&p_term=SP&p_deptname="+address
							+"&p_classif=--+Choose+a+Course+Classification+--&p_presuf=--+Choose+a+Course+Prefix/Suffix+--&x=45";
			break;
		}
		return cleanedURL;
	}
	
	/*
	 * 	Tries to get rid of noisy data from the coursesVectors
	 * 	flag values:
	 * 			0 -- unsorted data
	 * 			2 -- for Stanford
	 */
	public static void cleanData(Vector<CourseSubject> corrupted, int flag){
		// for berkeley
		if(flag == 3){
			corrupted.remove(0); 		
			corrupted.remove(0);		
			corrupted.remove(corrupted.size()-1);
		}
		if(flag == 2){
			for(int i = 0 ; i < 9; ++i){
				if( i < 5 )
					corrupted.remove(corrupted.size()-1);
				corrupted.remove(0);
			}
		}
		// sort the array if not sorted
		if( flag == 0 || flag == 2){

			int pos;
			for( int index = 0; index < corrupted.size(); ++index ){
				CourseSubject current = corrupted.get(index);
				String str = current.getTitle();
				if(( pos = str.indexOf('-')) != -1){
					current.setTitle(str.substring(pos+1).trim());
				}
				else
					current.setTitle(str.trim());
			}
			String[] titleArray = new String[corrupted.size()];
			URL[] urlArray = new URL[corrupted.size()];
			for(int i = 0; i < corrupted.size(); ++i){
				titleArray[i] = corrupted.get(i).getTitle().trim() +"%" + i;			// mapping function
				urlArray[i] = corrupted.get(i).getURL();
			}
			
			java.util.Arrays.sort(titleArray);	// sort the array
			corrupted.clear();// empties the vector
			
			//add the elements in order to the vector
			for(int i = 0; i < titleArray.length; ++i){
				if(titleArray[i].indexOf('%') != -1){

					CourseSubject courseSub = new CourseSubject(titleArray[i].substring(0, titleArray[i].indexOf('%')).trim(), null);
					int index = Integer.parseInt(titleArray[i].substring(titleArray[i].indexOf('%') + 1));
					
					courseSub.setURL(urlArray[index]);
					
					corrupted.add(courseSub);
				}
			}

		}
		
		// 1- remove parentheses
		for( int i = 0; i < corrupted.size(); ++i ){
			String str = corrupted.get(i).getTitle().toUpperCase();
			for( int j = 0; j < str.length(); ++j){
				if(str.charAt(j) == '('){
					str = str.substring(0, j-1);	// grabs the chunk before the parentheses
					break;
				}
				if(str.charAt(j) < 'A' || str.charAt(j) > 'Z'){
					str = str.replace(str.charAt(j), ' ');
				}
			}
			str = str.trim();
			corrupted.get(i).setTitle(str);
		}
		
		return;
	}

	
	public void assignClasses_UIUC(CourseSubject courseSub) throws IOException {
		URL url = courseSub.getURL();
		String sourceLine = "";
		String content = "";
		
		//System.out.println(url.toString());

		
		InputStreamReader pageInput = new InputStreamReader(url.openStream());
		BufferedReader source = new BufferedReader(pageInput);
		while( (sourceLine = source.readLine()) != null){
			content += sourceLine + "\n";
		}
		
		Pattern numberPattern = null;
		Pattern titlePattern = null;
		
		String regex0 = "<div class=\"ws-course-number mobile-course-number\">";
		String regex1 = "</div>";
		String regex2 = "<div class=\"ws-course-title mobile-course-title\"><a href.*?>";
		String regex3 = "</a></div>";
		
		numberPattern = Pattern.compile("<div class=\"ws-course-number mobile-course-number\">.*?</div>");
		titlePattern = Pattern.compile("<div class=\"ws-course-title mobile-course-title\"><a href.*?>.*?</a></div>");
		
		Matcher mnumber = numberPattern.matcher(content);
		Matcher mtitle = titlePattern.matcher(content);
		
		String tag = "";
		String tag1 = "";
		String[] strArray = null;
		String[] strArray1 = null;
		
		//System.out.println(mnumber.find());
		
		while(mnumber.find() && mtitle.find()){

			tag = mnumber.group();
			tag1 = mtitle.group();
			strArray = tag.split(regex0, 3);
			strArray1 = tag1.split(regex2, 3);
        	if(strArray.length != 1)
        		strArray = strArray[strArray.length-1].split(regex1, 3);		// str[0] holds the name of the course
        	if(strArray1.length != 1)
        		strArray1 = strArray1[strArray1.length-1].split(regex3, 3);
        	
        	strArray1[0] = HtmlManipulator.replaceHtmlEntities(strArray1[0]);
        	String courseName = strArray[0] + " - " + strArray1[0];
        	
			courseSub.addCourse(courseName);
		}
		
		pageInput.close();
		source.close();
		return;
	}
}
