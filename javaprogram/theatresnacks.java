
ohra went to a movie with his friends in a Wave theatre and during break time he bought pizzas, puffs and cool drinks. Consider the following prices :

Rs.100/pizza Rs.20/puffs Rs.10/cooldrink Generate a bill for What Vohra has bought.

Input Format

Sample Input 1:

Enter the no of pizzas bought:10

Enter the no of puffs bought:12

Enter the no of cool drinks bought:5

Constraints

Constraints: No Constraints

Output Format

Sample Output 1:

Bill Details

No of pizzas:10

No of puffs:12

No of cooldrinks:5

Total price=1290

Sample Input 0

12
7
3
Sample Output 0

Bill Details
No of pizzas:12
No of puffs:7
No of cooldrinks:3
Total price=1370
ENJOY THE SHOW!!!
Sample Input 1

11
12
19
Sample Output 1

Bill Details
No of pizzas:11
No of puffs:12
No of cooldrinks:19
Total price=1530
ENJOY THE SHOW!!!

Solution:

import java.io.*;
import java.util.*;
import java.text.*;
import java.math.*;
import java.util.regex.*;

public class Solution {

    public static void main(String[] args) {
        /* Enter your code here. Read input from STDIN. Print output to STDOUT. Your class should be named Solution. */
        Scanner ob=new Scanner(System.in);
        int pizza,puffs,cd;
        pizza=ob.nextInt();
        puffs=ob.nextInt();
       cd=ob.nextInt();
        int sp=pizza*100;
        int ss=puffs*20;
        int sd=cd*10;
        int price=sp+ss+sd;
        System.out.println("Bill Details");
        System.out.println("No of pizzas:"+pizza);
System.out.println("No of puffs:"+puffs);
System.out.println("No of cooldrinks:"+cd);
System.out.println("Total price="+price);
System.out.println("ENJOY THE SHOW!!!");
        
    }
}
