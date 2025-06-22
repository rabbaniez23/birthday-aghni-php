import React, { useState, useEffect } from 'react';
import { Send, Heart, MessageCircle, User } from 'lucide-react';
import { Wish } from '../types';

const Guestbook: React.FC = () => {
  const [wishes, setWishes] = useState<Wish[]>([]);
  const [newWish, setNewWish] = useState({ name: '', message: '' });

  useEffect(() => {
    const savedWishes = localStorage.getItem('birthday-wishes');
    if (savedWishes) {
      setWishes(JSON.parse(savedWishes));
    } else {
      // Add some default wishes
      const defaultWishes: Wish[] = [
        {
          id: '1',
          name: 'Sarah',
          message: 'Happy Birthday Aghni! Hope your special day is filled with happiness and love! 🎂💕',
          timestamp: new Date().toISOString()
        },
        {
          id: '2',
          name: 'Michael',
          message: 'Wishing you all the best on your birthday. May this new year bring you joy and success! 🎉✨',
          timestamp: new Date().toISOString()
        }
      ];
      setWishes(defaultWishes);
      localStorage.setItem('birthday-wishes', JSON.stringify(defaultWishes));
    }
  }, []);

  const addWish = () => {
    if (newWish.name && newWish.message) {
      const wish: Wish = {
        id: Date.now().toString(),
        name: newWish.name,
        message: newWish.message,
        timestamp: new Date().toISOString()
      };
      
      const updatedWishes = [wish, ...wishes];
      setWishes(updatedWishes);
      localStorage.setItem('birthday-wishes', JSON.stringify(updatedWishes));
      
      setNewWish({ name: '', message: '' });
    }
  };

  return (
    <div className="min-h-screen bg-gradient-to-br from-pink-200 via-purple-200 to-pink-300 pt-20 pb-12">
      <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* Header */}
        <div className="text-center mb-12">
          <h1 className="text-5xl md:text-6xl font-dancing font-bold text-purple-800 mb-4">
            💌 Birthday Wishes 💌
          </h1>
          <p className="text-xl text-purple-700 mb-8">
            Share your heartfelt birthday wishes for Aghni
          </p>
        </div>

        {/* Add Wish Form */}
        <div className="bg-white bg-opacity-90 backdrop-blur-md rounded-3xl p-8 shadow-xl mb-12">
          <div className="flex items-center space-x-2 mb-6">
            <MessageCircle className="text-pink-500" size={24} />
            <h2 className="text-2xl font-bold text-purple-800">Leave a Birthday Wish</h2>
          </div>
          
          <div className="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-2">
                Your Name
              </label>
              <div className="relative">
                <User className="absolute left-3 top-3 text-gray-400" size={20} />
                <input
                  type="text"
                  value={newWish.name}
                  onChange={(e) => setNewWish(prev => ({ ...prev, name: e.target.value }))}
                  placeholder="Enter your name"
                  className="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                />
              </div>
            </div>
            
            <div className="md:col-span-1">
              <label className="block text-sm font-medium text-gray-700 mb-2">
                Birthday Message
              </label>
              <textarea
                value={newWish.message}
                onChange={(e) => setNewWish(prev => ({ ...prev, message: e.target.value }))}
                placeholder="Write your heartfelt birthday wish..."
                rows={4}
                className="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent resize-none"
              />
            </div>
          </div>
          
          <button
            onClick={addWish}
            disabled={!newWish.name || !newWish.message}
            className="w-full md:w-auto bg-gradient-to-r from-pink-500 to-purple-500 text-white px-8 py-3 rounded-full font-semibold shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center space-x-2"
          >
            <Send size={20} />
            <span>Send Birthday Wish</span>
          </button>
        </div>

        {/* Wishes Display */}
        <div className="space-y-6">
          <h2 className="text-3xl font-bold text-purple-800 text-center mb-8 flex items-center justify-center space-x-2">
            <Heart className="text-pink-500" size={32} />
            <span>Birthday Wishes ({wishes.length})</span>
            <Heart className="text-pink-500" size={32} />
          </h2>
          
          {wishes.map((wish) => (
            <div
              key={wish.id}
              className="bg-white bg-opacity-80 backdrop-blur-md rounded-2xl p-6 shadow-lg hover:shadow-xl transform hover:scale-[1.02] transition-all duration-300 border-l-4 border-pink-400"
            >
              <div className="flex items-start space-x-4">
                <div className="flex-shrink-0">
                  <div className="w-12 h-12 bg-gradient-to-br from-pink-400 to-purple-400 rounded-full flex items-center justify-center text-white font-bold text-lg">
                    {wish.name.charAt(0).toUpperCase()}
                  </div>
                </div>
                
                <div className="flex-grow">
                  <div className="flex items-center space-x-2 mb-2">
                    <h3 className="font-bold text-purple-800 text-lg">{wish.name}</h3>
                    <span className="text-gray-500 text-sm">
                      {new Date(wish.timestamp).toLocaleDateString()}
                    </span>
                  </div>
                  
                  <p className="text-gray-700 leading-relaxed">{wish.message}</p>
                  
                  <div className="flex items-center space-x-2 mt-3">
                    <Heart className="text-pink-400" size={16} />
                    <span className="text-sm text-gray-500">With love</span>
                  </div>
                </div>
              </div>
            </div>
          ))}
          
          {wishes.length === 0 && (
            <div className="text-center py-12">
              <MessageCircle className="mx-auto text-gray-400 mb-4" size={48} />
              <p className="text-gray-500 text-lg">No wishes yet. Be the first to leave a birthday message!</p>
            </div>
          )}
        </div>
      </div>
    </div>
  );
};

export default Guestbook;