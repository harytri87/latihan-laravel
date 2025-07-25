import './bootstrap';
import { initModal } from './components/modal';
import { initProfilePicture } from './components/profilePicture';

document.addEventListener('DOMContentLoaded', () => {
	initModal();
	initProfilePicture('input-profile-pic', 'div-profile-pic'); // samain kayak id di input type file dan divnya
});