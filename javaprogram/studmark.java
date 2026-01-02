
John wants to know how to calculate the subject marks.could you please help him to learn marks calculation in programming.

Input Format

First input consists of String
Second input consists of integer
Third input consists of integer
Fourth input consists of integer
Fifth input consists of integer
Sixth input consists of integer
Constraints

No Constraints

Output Format

Execute the total and Average Marks.
Sample Input 0

John
100
99
100
100
99
Sample Output 0

Name of the Student:John
Total marks:498
Average marks:99.6
Soution:
import java.io.*;
import java.util.*;
import java.text.*;
import java.math.*;
import java.util.regex.*;

public class Solution {

    public static void main(String[] args) {
        /* Enter your code here. Read input from STDIN. Print output to STDOUT. Your class should be named Solution. */
        Scanner obj=new Scanner(System.in); 
        String name=obj.nextLine();
        int a=obj.nextInt();
        int b=obj.nextInt();
        int c=obj.nextInt();
        int d=obj.nextInt();
        int e=obj.nextInt();
        int total=a+b+c+d+e;
        float h=(float) Math.abs(total);
        float avg=h/5;
        System.out.println("Name of the Student:"+name);
        System.out.println("Total marks:"+total);
        System.out.println("Average marks:"+avg);
        
    }
}
