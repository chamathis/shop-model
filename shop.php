<?php 

interface ProductInterface {
    public function createProduct();
    public function updateProduct();
    public function addCategory();
    public function getCategories();

}


interface PhysicalProductInterface {
    public function updateStock();
}


interface DigitalProductInterface {
    public function sendDownloadLinkEmail();
    public function generateDownloadLink();
}


class Product implements ProductInterface {
    public $productId;
    public $name;    
    public $articleNumber;

    public function createProduct(){}
    public function updateProduct(){
        ProductUpdatedEvent::dispatch($productId);
    }
    public function addCategory(){}
    public function getCategories(){}

}


class PhysicalProduct extends Product implements PhysicalProductInterface {
    public $productId;
    public $stock;

    public function updateStock(){
        StockUpdatedEvent::dispatch($productId, $quantity);
    }

}


class DigitalProduct implements DigitalProductInterface {
    public function sendDownloadLinkEmail(){}
    public function generateDownloadLink(){}
}


class Picture {
    public $pictureId;
    public $url;
    public $productId;
}


class Price {
    public $priceId;
    public $price;
    public $productId;
}


class Category {
    public $categoryId;
    public $name;
    public $parentId;
   
    public createCategory(){}
    public getProducts(){}
    public assignProducts(){}
    public tree(){}
}


class ProductCategory {
    public $categoryId;
    public $productId;
}


class ShoppingCart {
    public $shoppingCartId;
    public $userId;
   
    public function addtoCart(){}
    public function removeFromCart(){}
    public function cartTotal(){}
    public function purchase(){}
}


class ShoppingCartItems {
    public $shoppingCartId;
    public $productId;
}



interface UserInterface {}


interface CustomerInterface {
    public function purchaseProducts();
}


interface SellerInterface {
    public function createProducts();
}


class User implements UserInterface {} 


class Seller extends User implements SellerInterface {
    public function createProduct();
}


class Customer extends User implements CustomerInterface {
    public function purchaseProducts();
}



class Events {
    public $listen = [
        [StockUpdatedEvent::class] = [
            SendStockUpdatesToSeller::class,
        ],
        [ProductUpdatedEvent::class] = [
            SendProductUpdatesToSeller::class,
        ],
    ];

}
