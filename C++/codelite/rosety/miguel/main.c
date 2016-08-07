/*
* Carlos Rosety 
* Practice 11
* 25-11-2015
* Program 4
*/

#include <stdio.h>
#define N 30
 
typedef struct {
	int day;
	int month;
} T_DATE;
typedef struct {
	int id;
	char name[100];
	char email[100];
	int age;
T_DATE birthdate;
int num_friends;
int id_friends[100];
}T_USER;

int UpdateAge(FILE *fp, int day, int month);

int main(void){
	FILE *fp;
	int i,j,n,tday, tmonth;
	tday=14;
	tmonth=12;
	T_USER user;

	fp=fopen("users.bin","rb+");
	if(fp==NULL){
		printf("ERROR opening the file");
	}else{
		/*printf("how many?=>");
		scanf("%d",&n);
		for(i=0;i<n;i++){
			user.id=i+1;
			fflush(stdin);
			printf("name:");
			gets(user.name);
			fflush(stdin);
			printf("email:");
			gets(user.email);
			
			printf("age:");
			scanf("%d",&(user.age));
			
			printf("month of birth:");
			scanf("%d",&(user.birthdate.month));
			
			printf("day of birth:");
			scanf("%d",&(user.birthdate.day));
			
			printf("number of friends:");
			scanf("%d",&(user.num_friends));
			
			for(j=0;j<user.num_friends;j++){
				printf("num %d=>",j+1);
				scanf("%d",&(user.id_friends[i]));
			}
			j=0;
			printf("\nnext\n\n");
			fwrite(&user,sizeof(T_USER),1,fp);
		}*/
		n=UpdateAge(fp,tday,tmonth);
		
		for(i=0;i<20;i++){
			rewind(fp);
			
			fread(&user,sizeof(T_USER),1,fp);
		}
		fclose(fp);
	}
	
	return 0;
}
int UpdateAge(FILE *fp, int day, int month){
	int n,ctrl;
	T_USER user;
	n=0;
	rewind(fp);
	do{
	//ctrl=fread(&user,sizeof(T_USER),1,fp);
		if(ctrl!=0 && user.birthdate.day==day && user.birthdate.month==month){
			user.age+=1;
			fseek(fp,(user.id)*sizeof(T_USER),SEEK_SET);
			fwrite(&user,sizeof(T_USER),1,fp);
			printf("hey, month is %d and day is %d",month,day);
			n++;
		}
	
	
	}while(ctrl!=0);
	return n;
}