-------------------------------------------------------------------------------------*
-- Create procedure to add categories to tbl_Category_lu.
-- Populate with initial records.
-------------------------------------------------------------------------------------*
drop procedure if exists mama.CategoryAdd;
create procedure mama.CategoryAdd(
  in name_in  varchar (30)
  )
begin

  insert into mama.tbl_Category_lu( name )
       values ( name_in );

end;

call mama.CategoryAdd('Food and Beverage');
call mama.CategoryAdd('Medicine');
call mama.CategoryAdd('School Supplies');
call mama.CategoryAdd('Hygiene');
call mama.CategoryAdd('Home Decor');
call mama.CategoryAdd('General');
call mama.CategoryAdd('Seasonal');
call mama.CategoryAdd('Toys');

-------------------------------------------------------------------------------------*
-- Create procedure to add customers to tbl_Customer.
-- Populate with initial records.
-------------------------------------------------------------------------------------*
drop procedure if exists mama.CustomerAdd;
create procedure mama.CustomerAdd(
  in nameFirst_in      varchar(30),
  in nameLast_in       varchar(30),
  in phoneNumber_in    varchar(12),
  in email_in          varchar(80)
  )
begin

  insert into mama.tbl_Customer( nameFirst, nameLast, phoneNumber, email, createdDate )
       values ( nameFirst_in, nameLast_in, phoneNumber_in, email_in, curdate() );

end;

call mama.CustomerAdd( 'Charles', 'Xavier', '111-111-9626', 'professorx@xmen.com' );
call mama.CustomerAdd( 'Scott', 'Summers', '222-222-9626', 'cyclops@xmen.com' );
call mama.CustomerAdd( 'Robert', 'Drake', '333-333-9626', 'iceman@xmen.com' );
call mama.CustomerAdd( 'Warren', 'Worthington', '444-444-9626', 'archangel@xmen.com' );
call mama.CustomerAdd( 'Henry', 'Mccoy', '555-555-9626', 'beast@xmen.com' );
call mama.CustomerAdd( 'Jean', 'Grey', '666-666-9626', 'phoenix@xmen.com' );
call mama.CustomerAdd( 'Ororo', 'Monroe', '777-777-9626', 'storm@xmen.com' );
call mama.CustomerAdd( 'Anna', 'Marie', '888-888-9626', 'rogue@xmen.com' );
call mama.CustomerAdd( 'Remy', 'LeBeau', '999-999-9626', 'gambit@xmen.com' );
call mama.CustomerAdd( 'Logan', 'Howlett', '000-000-9626', 'wolverine@xmen.com' );

-------------------------------------------------------------------------------------*
-- Create procedure to add employees to tbl_Employee.
-- Populate with initial records.
-------------------------------------------------------------------------------------*
drop procedure if exists mama.EmployeeAdd;
create procedure mama.EmployeeAdd(
  in logonName_in    varchar (15),
  in password_in     varchar (15),
  in nameFirst_in    varchar (30),
  in nameLast_in     varchar (30),
  in admin_in        varchar (1)
  )
begin

  insert into mama.tbl_Employee( logonName, password, nameFirst, nameLast, hireDate, admin )
       values ( logonName_in, password_in, nameFirst_in, nameLast_in, curdate(), admin_in );

end;

call mama.EmployeeAdd( 'mwoodie', 'password', 'Michael', 'Woodie', 'Y');
call mama.EmployeeAdd( 'cfreas', 'password', 'Chris', 'Freas', 'Y');
call mama.EmployeeAdd( 'blai', 'password', 'Brandon', 'Lai', 'Y');
call mama.EmployeeAdd( 'ggerst', 'password', 'Rhett', 'Gerst', 'Y');
call mama.EmployeeAdd( 'sluong', 'password', 'Seyana', 'Luong', 'Y');

-------------------------------------------------------------------------------------*
-- Create procedure to add products to tbl_Product.
-- Populate with initial records.
-------------------------------------------------------------------------------------*
drop procedure if exists mama.ProductAdd;
create procedure mama.ProductAdd(
  in categoryId_in       int     (9),
  in name_in             varchar (30),
  in price_in            decimal (9,2),
  in inventoryAmount_in  int     (9)
  )
begin

  insert into mama.tbl_Product( categoryId, name, price, inventoryAmount, lastStockDate )
       values ( categoryId_in, name_in, price_in, inventoryAmount_in, curdate() );
end;

call mama.ProductAdd( 1, 'Beer', 11.99, 15 );
call mama.ProductAdd( 1, 'Bread', 4.99, 15 );
call mama.ProductAdd( 1, 'Chips', 4.99, 10 );
call mama.ProductAdd( 1, 'Candy', 1.99, 10 );
call mama.ProductAdd( 2, 'Headache Powder', 9.99, 10 );
call mama.ProductAdd( 3, 'Notebook', 1.99, 20 );
call mama.ProductAdd( 4, 'Shampoo', 4.99, 8 );
call mama.ProductAdd( 4, 'Deodorant', 3.99, 10 );
call mama.ProductAdd( 4, 'Toothbrush', 2.99, 10 );
call mama.ProductAdd( 4, 'Toothpaste', 4.99, 10 );
call mama.ProductAdd( 4, 'Soap', 6.99, 8 );
call mama.ProductAdd( 5, 'Candles', 5.99, 6 );
call mama.ProductAdd( 6, 'Batteries', 7.99, 10 );
call mama.ProductAdd( 7, 'Casper Costume', 19.99, 4 );
call mama.ProductAdd( 7, 'Pumpkin', 13.99, 8 );
call mama.ProductAdd( 8, 'Cap Gun', 5.99, 5 );
call mama.ProductAdd( 8, 'Doll', 9.99, 5 );
call mama.ProductAdd( 8, 'Yo-Yo', 5.99, 5 );
