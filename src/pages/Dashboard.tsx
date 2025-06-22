import React, { useState, useEffect } from 'react';
import { Lock, Trash2, Image, MessageCircle, Eye, EyeOff } from 'lucide-react';
import { Photo, Wish } from '../types';

const Dashboard: React.FC = () => {
  const [isAuthenticated, setIsAuthenticated] = useState(false);
  const [password, setPassword] = useState('');
  const [showPassword, setShowPassword] = useState(false);
  const [photos, setPhotos] = useState<Photo[]>([]);
  const [wishes, setWishes] = useState<Wish[]>([]);
  const [activeTab, setActiveTab] = useState<'photos' | 'wishes'>('photos');

  const ADMIN_PASSWORD = 'aghni2025'; // In production, this should be properly secured

  useEffect(() => {
    const savedPhotos = localStorage.getItem('birthday-photos');
    if (savedPhotos) {
      setPhotos(JSON.parse(savedPhotos));
    }

    const savedWishes = localStorage.getItem('birthday-wishes');
    if (savedWishes) {
      setWishes(JSON.parse(savedWishes));
    }
  }, []);

  const handleLogin = () => {
    if (password === ADMIN_PASSWORD) {
      setIsAuthenticated(true);
      setPassword('');
    } else {
      alert('Incorrect password!');
    }
  };

  const deletePhoto = (id: string) => {
    if (confirm('Are you sure you want to delete this photo?')) {
      const updatedPhotos = photos.filter(photo => photo.id !== id);
      setPhotos(updatedPhotos);
      localStorage.setItem('birthday-photos', JSON.stringify(updatedPhotos));
    }
  };

  const deleteWish = (id: string) => {
    if (confirm('Are you sure you want to delete this wish?')) {
      const updatedWishes = wishes.filter(wish => wish.id !== id);
      setWishes(updatedWishes);
      localStorage.setItem('birthday-wishes', JSON.stringify(updatedWishes));
    }
  };

  if (!isAuthenticated) {
    return (
      <div className="min-h-screen bg-gradient-to-br from-purple-200 via-pink-200 to-purple-300 pt-20 pb-12 flex items-center justify-center">
        <div className="bg-white bg-opacity-90 backdrop-blur-md rounded-3xl p-8 shadow-2xl max-w-md w-full mx-4">
          <div className="text-center mb-8">
            <Lock className="mx-auto text-purple-600 mb-4" size={48} />
            <h1 className="text-3xl font-bold text-purple-800 mb-2">Admin Dashboard</h1>
            <p className="text-gray-600">Enter password to access dashboard</p>
          </div>
          
          <div className="space-y-6">
            <div className="relative">
              <input
                type={showPassword ? 'text' : 'password'}
                value={password}
                onChange={(e) => setPassword(e.target.value)}
                placeholder="Enter admin password"
                className="w-full p-4 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                onKeyPress={(e) => e.key === 'Enter' && handleLogin()}
              />
              <button
                type="button"
                onClick={() => setShowPassword(!showPassword)}
                className="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700"
              >
                {showPassword ? <EyeOff size={20} /> : <Eye size={20} />}
              </button>
            </div>
            
            <button
              onClick={handleLogin}
              className="w-full bg-gradient-to-r from-purple-500 to-pink-500 text-white py-4 rounded-lg font-semibold shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300"
            >
              Access Dashboard
            </button>
            
            <div className="text-center">
              <p className="text-sm text-gray-500">
                Demo password: <code className="bg-gray-100 px-2 py-1 rounded">aghni2025</code>
              </p>
            </div>
          </div>
        </div>
      </div>
    );
  }

  return (
    <div className="min-h-screen bg-gradient-to-br from-purple-200 via-pink-200 to-purple-300 pt-20 pb-12">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* Header */}
        <div className="text-center mb-12">
          <h1 className="text-5xl md:text-6xl font-dancing font-bold text-purple-800 mb-4">
            🎛️ Admin Dashboard 🎛️
          </h1>
          <p className="text-xl text-purple-700 mb-8">
            Manage photos and birthday wishes
          </p>
          
          <button
            onClick={() => setIsAuthenticated(false)}
            className="bg-gray-500 text-white px-6 py-2 rounded-full hover:bg-gray-600 transition-colors duration-200"
          >
            Logout
          </button>
        </div>

        {/* Stats Cards */}
        <div className="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
          <div className="bg-white bg-opacity-80 backdrop-blur-md rounded-2xl p-6 shadow-lg">
            <div className="flex items-center justify-between">
              <div>
                <h3 className="text-2xl font-bold text-purple-800">{photos.length}</h3>
                <p className="text-gray-600">Total Photos</p>
              </div>
              <Image className="text-purple-500" size={32} />
            </div>
          </div>
          
          <div className="bg-white bg-opacity-80 backdrop-blur-md rounded-2xl p-6 shadow-lg">
            <div className="flex items-center justify-between">
              <div>
                <h3 className="text-2xl font-bold text-pink-800">{wishes.length}</h3>
                <p className="text-gray-600">Birthday Wishes</p>
              </div>
              <MessageCircle className="text-pink-500" size={32} />
            </div>
          </div>
        </div>

        {/* Tabs */}
        <div className="bg-white bg-opacity-80 backdrop-blur-md rounded-2xl shadow-lg overflow-hidden">
          <div className="flex border-b border-gray-200">
            <button
              onClick={() => setActiveTab('photos')}
              className={`flex-1 py-4 px-6 text-center font-semibold transition-colors duration-200 ${
                activeTab === 'photos'
                  ? 'bg-purple-500 text-white'
                  : 'text-purple-600 hover:bg-purple-50'
              }`}
            >
              <Image className="inline mr-2" size={20} />
              Manage Photos
            </button>
            <button
              onClick={() => setActiveTab('wishes')}
              className={`flex-1 py-4 px-6 text-center font-semibold transition-colors duration-200 ${
                activeTab === 'wishes'
                  ? 'bg-pink-500 text-white'
                  : 'text-pink-600 hover:bg-pink-50'
              }`}
            >
              <MessageCircle className="inline mr-2" size={20} />
              Manage Wishes
            </button>
          </div>

          <div className="p-6">
            {activeTab === 'photos' ? (
              <div>
                <h3 className="text-xl font-bold text-purple-800 mb-6">Photo Management</h3>
                {photos.length === 0 ? (
                  <p className="text-gray-500 text-center py-8">No photos uploaded yet.</p>
                ) : (
                  <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    {photos.map((photo) => (
                      <div key={photo.id} className="bg-gray-50 rounded-lg overflow-hidden">
                        <div className="aspect-square relative">
                          <img
                            src={photo.url}
                            alt={photo.caption}
                            className="w-full h-full object-cover"
                          />
                        </div>
                        <div className="p-4">
                          <p className="font-semibold text-gray-800 truncate">{photo.caption}</p>
                          <p className="text-sm text-gray-500 mb-3">
                            {new Date(photo.uploadDate).toLocaleDateString()}
                          </p>
                          <button
                            onClick={() => deletePhoto(photo.id)}
                            className="w-full bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600 transition-colors duration-200 flex items-center justify-center space-x-1"
                          >
                            <Trash2 size={16} />
                            <span>Delete</span>
                          </button>
                        </div>
                      </div>
                    ))}
                  </div>
                )}
              </div>
            ) : (
              <div>
                <h3 className="text-xl font-bold text-pink-800 mb-6">Wishes Management</h3>
                {wishes.length === 0 ? (
                  <p className="text-gray-500 text-center py-8">No wishes submitted yet.</p>
                ) : (
                  <div className="space-y-4">
                    {wishes.map((wish) => (
                      <div key={wish.id} className="bg-gray-50 rounded-lg p-4">
                        <div className="flex justify-between items-start">
                          <div className="flex-grow">
                            <div className="flex items-center space-x-2 mb-2">
                              <h4 className="font-bold text-gray-800">{wish.name}</h4>
                              <span className="text-sm text-gray-500">
                                {new Date(wish.timestamp).toLocaleDateString()}
                              </span>
                            </div>
                            <p className="text-gray-700">{wish.message}</p>
                          </div>
                          <button
                            onClick={() => deleteWish(wish.id)}
                            className="ml-4 bg-red-500 text-white p-2 rounded-lg hover:bg-red-600 transition-colors duration-200 flex-shrink-0"
                          >
                            <Trash2 size={16} />
                          </button>
                        </div>
                      </div>
                    ))}
                  </div>
                )}
              </div>
            )}
          </div>
        </div>
      </div>
    </div>
  );
};

export default Dashboard;