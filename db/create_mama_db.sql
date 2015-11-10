-- Create database Mama; schema and objects

-- *****CREATE SCHEMA*****--
drop database if exists mama;
create schema mama;
grant all on mama.* to 'mama_tester'@'localhost' identified by 'test1234';
grant all on mama.* to 'mama_tester'@'127.0.0.1' identified by 'test1234';

-- *****CREATE TABLES*****--
-- -----------------------------------------------------------------------------------*
--  Category_lu - Table
-- -----------------------------------------------------------------------------------*
create table mama.tbl_Category_lu(
  categoryId         int       (9)  auto_increment   not null,
  name               varchar  (30)                   not null,
  primary key (categoryId)
  )
  engine = InnoDB row_format = default;

-- -----------------------------------------------------------------------------------*
--  Coupon - Table
-- -----------------------------------------------------------------------------------*
create table mama.tbl_Coupon(
  couponId           int       (9)  auto_increment   not null,
  amount             decimal (9,2)                   not null,
  name               varchar  (30)                   not null,
  startDate          date                            not null,
  endDate            date                            not null,
  primary key (couponId)
  )
  engine = InnoDB row_format = default;

-- -----------------------------------------------------------------------------------*
--  Customer - Table
-- -----------------------------------------------------------------------------------*
create table mama.tbl_Customer(
  customerId         int       (9)  auto_increment   not null,
  nameFirst          varchar  (30)                   not null,
  nameLast           varchar  (30)                   not null,
  phoneNumber        varchar  (12)                   not null,
  email              varchar  (80)                   not null,
  createdDate        date                            not null,
  primary key (customerId)
  )
  engine = InnoDB row_format = default;

-- -----------------------------------------------------------------------------------*
--  Employee - Table
-- -----------------------------------------------------------------------------------*
create table mama.tbl_Employee(
  employeeId         int       (9)  auto_increment   not null,
  logonName          varchar  (15)                   not null,
  password           varchar  (255)                  not null,
  nameFirst          varchar  (30)                   not null,
  nameLast           varchar  (30)                   not null,
  hireDate           date                            not null,
  endDate            date,
  admin              varchar   (1)                   not null,
  title              varchar  (50),
  primary key (employeeId)
  )
  engine = InnoDB row_format = default;

-- -----------------------------------------------------------------------------------*
--  Product - Table
-- -----------------------------------------------------------------------------------*
create table mama.tbl_Product(
  productId          int       (9)  auto_increment   not null,
  categoryId         int       (9)                   not null,
  name               varchar  (30)                   not null,
  price              decimal (9,2)                   not null,
  inventoryAmount    int       (9)                   not null,
  lastStockDate      date                            not null,
  primary key (productId)
  )
  engine = InnoDB row_format = default;

-- -----------------------------------------------------------------------------------*
--  ProductCoupon - Table
-- -----------------------------------------------------------------------------------*
create table mama.tbl_ProductCoupon(
  productId          int       (9)                   not null,
  couponId           int       (9)                   not null,
  primary key (productId, couponId)
  )
  engine = InnoDB row_format = default;

-- -----------------------------------------------------------------------------------*
--  Sale - Table
-- -----------------------------------------------------------------------------------*
create table mama.tbl_Sale(
  saleId             int       (9)  auto_increment   not null,
  cashierId          int       (9)                   not null,
  customerId         int       (9)                   not null,
  saleTotal          decimal (9,2)                   not null,
  saleDate           date                            not null,
  primary key (saleId)
  )
  engine = InnoDB row_format = default;

-- -----------------------------------------------------------------------------------*
--  SaleProduct - Table
-- -----------------------------------------------------------------------------------*
create table mama.tbl_SaleProduct(
  saleId             int       (9)                   not null,
  productId          int       (9)                   not null,
  couponId           int       (9),
  amount             int       (9)                   not null,
  primary key (saleId, productId)
  )
  engine = InnoDB row_format = default;

-- *****CREATE VIEWS*****--
-- -----------------------------------------------------------------------------------*
--  CustomerSales_v
-- -----------------------------------------------------------------------------------*
create or replace view mama.CustomerSales_v as
  select s.saleId,
         s.saleTotal,
         s.saleDate,
         c.customerId,
         c.nameFirst,
         c.nameLast
    from mama.tbl_Sale s
    join mama.tbl_Customer c
      on c.customerId = s.customerId;
	 
-- -----------------------------------------------------------------------------------*
--  CustomerLastVisit_v
-- -----------------------------------------------------------------------------------*
create or replace view mama.CustomerLastVisit_v as
  select s.customerId,
         c.nameFirst,
         c.nameLast,
         max(s.saleDate) as "lastseen"
    from mama.tbl_Sale s
    join mama.tbl_Customer c
      on c.customerId = s.customerId
group by s.customerId,
         c.nameFirst,
         c.nameLast;

-- -----------------------------------------------------------------------------------*
--  ProductPurchaseTotals_v
-- -----------------------------------------------------------------------------------*
create or replace view mama.ProductPurchaseTotals_v as
  select sp.productId,
         p.name,
         count(sp.productId)
    from mama.tbl_SaleProduct sp
    join mama.tbl_Product p
      on p.productId = sp.productId
group by sp.productId,
         p.name;

-- -----------------------------------------------------------------------------------*
--  ProductSales_v
-- -----------------------------------------------------------------------------------*
create or replace view mama.ProductSales_v as
  select sp.saleId,
         sp.productId,
         sp.amount,
         ( sp.amount * p.price ) as productTotal,
         s.customerId,
         s.saleDate,
         p.name,
         p.price
    from mama.tbl_SaleProduct sp
    join mama.tbl_Sale s
      on s.saleId = sp.saleId
    join mama.tbl_Product p
      on p.productId = sp.productId;

-- *****CREATE INDEXES*****--
-- -----------------------------------------------------------------------------------*
--  Coupon - Index
-- -----------------------------------------------------------------------------------*
alter table mama.tbl_Coupon
  add index idx_tbl_Coupon_CouponId (couponId);

-- -----------------------------------------------------------------------------------*
--  Customer - Index
-- -----------------------------------------------------------------------------------*
alter table mama.tbl_Customer
  add index idx_tbl_Customer_CustomerId (customerId);

-- -----------------------------------------------------------------------------------*
--  Employee - Index
-- -----------------------------------------------------------------------------------*
alter table mama.tbl_Employee
  add index idx_tbl_Employee_EmployeeId (employeeId);

-- -----------------------------------------------------------------------------------*
--  Product - Index
-- -----------------------------------------------------------------------------------*
alter table mama.tbl_Product
  add index idx_tbl_Product_ProductId (productId);

-- -----------------------------------------------------------------------------------*
--  ProductCoupon - Index
-- -----------------------------------------------------------------------------------*
alter table mama.tbl_ProductCoupon
  add index idx_tbl_ProductCoupon_ProductId (productId);

alter table mama.tbl_ProductCoupon
  add index idx_tbl_ProductCoupon_CouponId (couponId);

-- -----------------------------------------------------------------------------------*
--  Sale - Index
-- -----------------------------------------------------------------------------------*
alter table mama.tbl_Sale
  add index idx_tbl_Sale_SaleId (saleId);

alter table mama.tbl_Sale
  add index idx_tbl_Sale_CashierId (cashierId);

alter table mama.tbl_Sale
  add index idx_tbl_Sale_CustomerId (customerId);

-- -----------------------------------------------------------------------------------*
--  SaleProduct - Index
-- -----------------------------------------------------------------------------------*
alter table mama.tbl_SaleProduct
  add index idx_tbl_SaleProduct_SaleId (saleId);

alter table mama.tbl_SaleProduct
  add index idx_tbl_SaleProduct_ProductId (productId);

-- *****CREATE FK CONSTRAINTS*****--

-- -----------------------------------------------------------------------------------*
--  Product - FK
-- -----------------------------------------------------------------------------------*
alter table mama.tbl_Product
  add constraint fk_tbl_Product_CategoryId
  foreign key (categoryId)
  references mama.tbl_Category_lu (categoryId)
  on update restrict
  on delete restrict;

-- -----------------------------------------------------------------------------------*
--  ProductCoupon - FK
-- -----------------------------------------------------------------------------------*
alter table mama.tbl_ProductCoupon
  add constraint fk_tbl_ProductCoupon_ProductId
  foreign key (productId)
  references mama.tbl_Product (productId)
  on update restrict
  on delete restrict;

alter table mama.tbl_ProductCoupon
  add constraint fk_tbl_ProductCoupon_CouponId
  foreign key (couponId)
  references mama.tbl_Coupon (couponId)
  on update restrict
  on delete restrict;

-- -----------------------------------------------------------------------------------*
--  Sale - FK
-- -----------------------------------------------------------------------------------*
alter table mama.tbl_Sale
  add constraint fk_tbl_Sale_CustomerId
  foreign key (customerId)
  references mama.tbl_Customer (customerId)
  on update restrict
  on delete restrict;

alter table mama.tbl_Sale
  add constraint fk_tbl_Sale_CashierId
  foreign key (cashierId)
  references mama.tbl_Employee (employeeId)
  on update restrict
  on delete restrict;

-- -----------------------------------------------------------------------------------*
--  SaleProduct - FK
-- -----------------------------------------------------------------------------------*
alter table mama.tbl_SaleProduct
  add constraint fk_tbl_SaleProduct_SaleId
  foreign key (saleId)
  references mama.tbl_Sale (saleId)
  on update restrict
  on delete restrict;

alter table mama.tbl_SaleProduct
  add constraint fk_tbl_SaleProduct_ProductId
  foreign key (productId)
  references mama.tbl_Product (productId)
  on update restrict
  on delete restrict;

alter table mama.tbl_SaleProduct
  add constraint fk_tbl_SaleProduct_ProductCouponId
  foreign key (productId, couponId)
  references mama.tbl_ProductCoupon (productId, couponId)
  on update restrict
  on delete restrict;
