-- -----------------------------------------------------------------------------------*
--  Start by deleting all data before running to avoid duplicates.
-- -----------------------------------------------------------------------------------*
delete from mama.tbl_SaleProduct;
delete from mama.tbl_Sale;
delete from mama.tbl_ProductCoupon;
delete from mama.tbl_Coupon;
delete from mama.tbl_Product;
delete from mama.tbl_Customer;
delete from mama.tbl_Employee;
delete from mama.tbl_Category_lu;

-- -----------------------------------------------------------------------------------*
--  Create procedure to add categories to tbl_Category_lu.
--  Populate with initial records.
-- -----------------------------------------------------------------------------------*
drop procedure if exists mama.CategoryAdd;
delimiter $$
create procedure mama.CategoryAdd(
  in name_in  varchar (30)
  )
begin

  insert into mama.tbl_Category_lu( name )
       values ( name_in );

end$$
delimiter ;

call mama.CategoryAdd('Food and Beverage');
call mama.CategoryAdd('Medicine');
call mama.CategoryAdd('School Supplies');
call mama.CategoryAdd('Hygiene');
call mama.CategoryAdd('Home Decor');
call mama.CategoryAdd('General');
call mama.CategoryAdd('Seasonal');
call mama.CategoryAdd('Toys');
call mama.CategoryAdd('Tobacco');

-- -----------------------------------------------------------------------------------*
--  Create procedure to add customers to tbl_Customer.
--  Populate with initial records.
-- -----------------------------------------------------------------------------------*
drop procedure if exists mama.CustomerAdd;
delimiter $$
create procedure mama.CustomerAdd(
  in nameFirst_in      varchar(30),
  in nameLast_in       varchar(30),
  in phoneNumber_in    varchar(12),
  in email_in          varchar(80)
  )
begin

  insert into mama.tbl_Customer( nameFirst, nameLast, phoneNumber, email, createdDate )
       values ( nameFirst_in, nameLast_in, phoneNumber_in, email_in, curdate() );

end$$

delimiter ;

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

-- -----------------------------------------------------------------------------------*
--  Create procedure to add employees to tbl_Employee.
--  Populate with initial records.
-- -----------------------------------------------------------------------------------*
drop procedure if exists mama.EmployeeAdd;
delimiter $$
create procedure mama.EmployeeAdd(
  in logonName_in    varchar (15),
  in password_in     varchar (255),
  in nameFirst_in    varchar (30),
  in nameLast_in     varchar (30),
  in admin_in        varchar (1)
  )
begin

  insert into mama.tbl_Employee( logonName, password, nameFirst, nameLast, hireDate, admin )
       values ( logonName_in, password_in, nameFirst_in, nameLast_in, curdate(), admin_in );

end$$

delimiter ;

call mama.EmployeeAdd( 'mwoodie', '5f4dcc3b5aa765d61d8327deb882cf99', 'Michael', 'Woodie', 'Y');
call mama.EmployeeAdd( 'cfreas', '5f4dcc3b5aa765d61d8327deb882cf99', 'Chris', 'Freas', 'Y');
call mama.EmployeeAdd( 'blai', '5f4dcc3b5aa765d61d8327deb882cf99', 'Brandon', 'Lai', 'Y');
call mama.EmployeeAdd( 'ggerst', '5f4dcc3b5aa765d61d8327deb882cf99', 'Rett', 'Gerst', 'Y');
call mama.EmployeeAdd( 'sluong', '5f4dcc3b5aa765d61d8327deb882cf99', 'Seyana', 'Luong', 'Y');

-- -----------------------------------------------------------------------------------*
--  Create procedure to add products to tbl_Product.
--  Populate with initial records.
-- -----------------------------------------------------------------------------------*
drop procedure if exists mama.ProductAdd;
delimiter $$
create procedure mama.ProductAdd(
  in categoryId_in       int     (9),
  in name_in             varchar (30),
  in price_in            decimal (9,2),
  in inventoryAmount_in  int     (9)
  )
begin

  insert into mama.tbl_Product( categoryId, name, price, inventoryAmount, lastStockDate )
       values ( categoryId_in, name_in, price_in, inventoryAmount_in, curdate() );
end$$

delimiter ;

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
call mama.ProductAdd( 9, 'Dip', 6.99, 10 );
call mama.ProductAdd( 9, 'Cigars', 9.99, 10 );

-- -----------------------------------------------------------------------------------*
--  Create procedure to add sales to tbl_Sale.
-- -----------------------------------------------------------------------------------*
drop procedure if exists mama.SaleAdd;
delimiter $$
create procedure mama.SaleAdd(
  in cashierId_in   int (9),
  in customerId_in  int (9),
  in day_in         int (9)
  )
begin
	
  insert into mama.tbl_Sale( cashierId, customerId, saleTotal, saleDate )
       values ( cashierId_in, customerId_in, 0.00, curdate() - interval day_in day);
end$$
delimiter ;

-- -----------------------------------------------------------------------------------*
--  Create procedure to update saleTotal on tbl_Sale.
-- -----------------------------------------------------------------------------------*
drop procedure if exists mama.SaleUpdateSaleTotal;
delimiter $$
create procedure mama.SaleUpdateSaleTotal(
  in saleId_in   int (9)
  )
begin
	declare mtotal decimal(9,2);
	
	select sum(p.price * sp.amount) as total
	  into mtotal
	  from mama.tbl_SaleProduct sp
	  join mama.tbl_Product p
	    on p.productId = sp.productId
	 where sp.saleId = saleId_in;
	 
	update mama.tbl_Sale
	   set saleTotal = mtotal
	 where saleId = saleId_in;
	
end$$
delimiter ;

-- -----------------------------------------------------------------------------------*
--  Create procedure to add product purchases to tbl_SaleProduct.
-- -----------------------------------------------------------------------------------*
drop procedure if exists mama.SaleProductAdd;
delimiter $$
create procedure mama.SaleProductAdd(
  in saleId_in     int (9),
  in productId_in  int (9),
  in amount_in     int (9)
  )
begin
	
  insert into mama.tbl_SaleProduct( saleId, productId, amount )
       values ( saleId_in, productId_in, amount_in );
end$$
delimiter ;

-- -----------------------------------------------------------------------------------*
--  Populate tbl_Sale and tbl_SaleProduct
-- -----------------------------------------------------------------------------------*
call mama.SaleAdd( 1,1, 60);
call mama.SaleProductAdd( 1,8,1);
call mama.SaleProductAdd( 1,5,3);
call mama.SaleProductAdd( 1,2,2);
call mama.SaleUpdateSaleTotal(1);

call mama.SaleAdd( 1,2, 5);
call mama.SaleProductAdd( 2,1,1);
call mama.SaleProductAdd( 2,2,2);
call mama.SaleProductAdd( 2,4,2);
call mama.SaleUpdateSaleTotal(2);

call mama.SaleAdd( 1,3, 94);
call mama.SaleProductAdd( 3,6,1);
call mama.SaleUpdateSaleTotal(3);

call mama.SaleAdd( 1,4, 7);
call mama.SaleProductAdd( 4,8,1);
call mama.SaleProductAdd( 4,10,2);
call mama.SaleUpdateSaleTotal(4);

call mama.SaleAdd( 2,5, 14);
call mama.SaleProductAdd( 5,8,1);
call mama.SaleProductAdd( 5,10,2);
call mama.SaleProductAdd( 5,11,1);
call mama.SaleUpdateSaleTotal(5);

call mama.SaleAdd( 2,6, 6);
call mama.SaleProductAdd( 6,8,1);
call mama.SaleProductAdd( 6,10,1);
call mama.SaleProductAdd( 6,1,2);
call mama.SaleProductAdd( 6,12,1);
call mama.SaleProductAdd( 6,5,2);
call mama.SaleUpdateSaleTotal(6);

call mama.SaleAdd( 3,1, 3);
call mama.SaleProductAdd( 7,13,1);
call mama.SaleProductAdd( 7,9,3);
call mama.SaleProductAdd( 7,7,2);
call mama.SaleUpdateSaleTotal(7);

call mama.SaleAdd( 5,2,14);
call mama.SaleProductAdd( 8,20,1);
call mama.SaleUpdateSaleTotal(8);

call mama.SaleAdd( 5,7, 67);
call mama.SaleProductAdd( 9,20,1);
call mama.SaleUpdateSaleTotal(9);

call mama.SaleAdd( 5,8, 2);
call mama.SaleProductAdd( 10,17,2);
call mama.SaleProductAdd( 10,16,1);
call mama.SaleProductAdd( 10,13,3);
call mama.SaleUpdateSaleTotal(10);

call mama.SaleAdd( 5,9, 22);
call mama.SaleProductAdd( 11,18,2);
call mama.SaleProductAdd( 11,6,1);
call mama.SaleProductAdd( 11,2,3);
call mama.SaleUpdateSaleTotal(11);

call mama.SaleAdd( 5,10, 4);
call mama.SaleProductAdd( 12,8,1);
call mama.SaleProductAdd( 12,6,1);
call mama.SaleProductAdd( 12,2,3);
call mama.SaleProductAdd( 12,16,3);
call mama.SaleProductAdd( 12,7,1);
call mama.SaleProductAdd( 12,3,1);
call mama.SaleUpdateSaleTotal(12);
