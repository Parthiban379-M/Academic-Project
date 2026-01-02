Veena wants to learn shape calculation for Square,Rectangle,Circle,Triangle to implements in programming.Could you please help her to how to write the program. - Square formula:a*a - Rectangle formula:l*b - Circle formula:πr^2 - Triangle formula:1/2*(b*h)

Input Format

First input consist of integer for side.
Second and third input consists of integer for Length and breadth.
forth input consist of radius.
Fifth and Sixth input consist of Base and height.
Constraints

No Constraints

Output Format

Execute the area of shape calculation values.
Sample Input 0

2
3
2
3
6
5
Sample Output 0

Area of Square=4
Area of Rectangle=6
Area of Circle=28.27
Area of Triangle=15
Sample Input 1

2
3
4
5
6
7
Sample Output 1

Area of Square=4
Area of Rectangle=12
Area of Circle=78.53
Area of Triangle=21

Solution:

import java.io.*;
import java.util.*;
import java.text.*;
import java.math.*;
import java.util.regex.*;

public class Solution {

    public static void main(String[] args) {
        /* Enter your code here. Read input from STDIN. Print output to STDOUT. Your class should be named Solution. */
        Scanner obj=new Scanner(System.in);
        int a,l,b,r,h,b1,h1;
        a=obj.nextInt();
        int sq=a*a;
        l=obj.nextInt();
        b=obj.nextInt();
        int rect=l*b;
        r=obj.nextInt();
        double  circle=Math.floor(Math.PI*Math.pow(r,2)*100)/100;
        float x=(float) circle;
        b1=obj.nextInt();
        h1=obj.nextInt();
        double  tri=0.5*b1*h1;
        int tri1=(int) tri;
        System.out.println("Area of Square="+sq);
         System.out.println("Area of Rectangle="+rect);
        System.out.printf("Area of Circle=%.2f\n",circle);
        System.out.println("Area of Triangle="+tri1);
    }
}