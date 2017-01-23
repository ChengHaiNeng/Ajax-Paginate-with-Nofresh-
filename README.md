# Ajax-Paginate-with-Nofresh-
Ajax Paginate with Nofresh ,实现Ajax 无刷新分页


data.php : Ajax需要调用并返回的分页代码,内部调用page.class.php封装类
index.html: 是需要实现无刷新分页的首页面，通过Ajax异步方法(showpage)调用data.php返回来显示
page.class.php: 是封装好的分页类