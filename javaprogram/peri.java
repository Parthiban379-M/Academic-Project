
Veena wants to learn shape calculation for Square,Rectangle,Circle,Triangle to implements in programming.Could you please help her to how to write the program. Notes: - Square formula:4a - Rectangle formula:2(l+w) - Circle formula:2πr - Triangle formula:side+base+side

Input Format

First input consist of integer for side.
Second and third input consists of integer for Length and Width.
forth input consist of radius.
Fifth,Sixth and Seventh input consist of Base1,side and Base2 .
Constraints

No Constraints

Output Format

Execute the area of shape calculation values.
Sample Input 0

9
8
7
6
5
4
3
Sample Output 0

Perimeter of Square:36
Perimeter of Rectangle:30
Perimeter of Circle:37.69
Perimeter of Triangle:12

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
        int a,l,w,r,b1,s,b2,sq,rect,tri;
        double circ;
        a=obj.nextInt();
        l=obj.nextInt();
        w=obj.nextInt();
        r=obj.nextInt();
        b1=obj.nextInt();
        s=obj.nextInt();
        b2=obj.nextInt();
        sq=4*a;
        rect=2*(l+w);
        circ=Math.floor(2*(Math.PI*r)*100)/100;
        tri=b1+s+b2;
        System.out.println("Perimeter of Square:"+sq);
        System.out.println("Perimeter of Rectangle:"+rect);
        System.out.printf("Perimeter of Circle:%.2f",circ);
        System.out.println("");
        System.out.println("Perimeter of Triangle:"+tri);
        
        
    }
}
