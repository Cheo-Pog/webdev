<?php
namespace App\Services;

use App\Repositories\CartRepository;

class CartService
{

    private $CartRepository;

    public function __construct()
    {
        $this->CartRepository = new CartRepository;
    }

    public function getCartByUserId($userId)
    {
        return $this->CartRepository->getCartByUserId($userId);
    }

    public function checkout($cart, $subtotal): bool
    {
            return $this->CartRepository->checkout($cart, $subtotal);
    }
    public function addToCart($productId)
    {
        $cart = $this->CartRepository->getCartByUserId($_SESSION['currentUser']->id);
        if (count($cart) == 0) {
            $this->CartRepository->addToCart($productId, $_SESSION['currentUser']->id);
            return;
        }
        foreach ($cart as $item) {
            if ($item->productId == $productId) {
                $this->CartRepository->updateQuantity($item->id, $item->quantity + 1);
                return;
            }
        }
        $this->CartRepository->addToCart($productId, $_SESSION['currentUser']->id);
    }
    public function updateQuantity($id, $quantity)
    {
        $this->CartRepository->updateQuantity($id, $quantity);
    }
    public function removeFromCart($id)
    {
        $this->CartRepository->removeFromCart($id, $_SESSION['currentUser']->id);
    }
}