/*
* Carlos Rosety 
* Practice 11
* 20-11-2015
* Program 2
*/

#include <stdio.h>


#define N 50
 
 int main(void){
double temp;
int i, pos, ctrl;

FILE *fp;

fp=fopen("temperature.txt","r");
if(fp==NULL){
	printf("ERROR opening the file");
}else{
	for(i=0;i<30;i++){ 
		ctrl= fscanf(fp, "%d %lf\n",&temp,&pos);
		if(ctrl==2){
			printf("the temperature of day %d is %lf\n",pos, temp);
		}		
	}
	fclose(fp);
}
   return 0;
}
