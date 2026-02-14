/**
 * Development-only logger utility
 * 
 * IMPORTANT: Use these functions instead of console.log, console.error, etc.
 * They will automatically be disabled in production builds.
 * 
 * Usage:
 *   import { devLog, devError, devWarn } from '@/lib/logger';
 *   
 *   devLog('This will only show in development');
 *   devError('Error message');
 *   devWarn('Warning message');
 * 
 * All console.* statements in the codebase will be automatically removed
 * during production builds via vite-plugin-remove-console.
 */

/**
 * Check if we're in development mode
 */
const isDevelopment = () => {
    return import.meta.env.DEV;
};

/**
 * Development-only console.log
 * @param {...any} args - Arguments to log
 */
export const devLog = (...args) => {
    if (isDevelopment()) {
        console.log(...args);
    }
};

/**
 * Development-only console.error
 * @param {...any} args - Arguments to log
 */
export const devError = (...args) => {
    if (isDevelopment()) {
        console.error(...args);
    }
};

/**
 * Development-only console.warn
 * @param {...any} args - Arguments to log
 */
export const devWarn = (...args) => {
    if (isDevelopment()) {
        console.warn(...args);
    }
};

/**
 * Development-only console.info
 * @param {...any} args - Arguments to log
 */
export const devInfo = (...args) => {
    if (isDevelopment()) {
        console.info(...args);
    }
};

/**
 * Development-only console.debug
 * @param {...any} args - Arguments to log
 */
export const devDebug = (...args) => {
    if (isDevelopment()) {
        console.debug(...args);
    }
};

/**
 * Development-only console.table
 * @param {any} data - Data to display as table
 */
export const devTable = (data) => {
    if (isDevelopment()) {
        console.table(data);
    }
};

/**
 * Development-only console.group
 * @param {string} label - Group label
 */
export const devGroup = (label) => {
    if (isDevelopment()) {
        console.group(label);
    }
};

/**
 * Development-only console.groupEnd
 */
export const devGroupEnd = () => {
    if (isDevelopment()) {
        console.groupEnd();
    }
};

// Default export for convenience
export default {
    log: devLog,
    error: devError,
    warn: devWarn,
    info: devInfo,
    debug: devDebug,
    table: devTable,
    group: devGroup,
    groupEnd: devGroupEnd,
};
